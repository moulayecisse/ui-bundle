// assets/controllers/command_palette_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["modal", "backdrop", "panel", "input", "results", "empty", "group", "item"]
    static values = {
        open: { type: Boolean, default: false },
        shortcut: { type: String, default: "k" },
        shortcutModifier: { type: String, default: "meta" }, // meta, ctrl, alt
        closeOnSelect: { type: Boolean, default: true }
    }

    connect() {
        this.isOpen = false
        this.activeIndex = -1
        this.filteredItems = []

        // Bind methods
        this.handleGlobalKeydown = this.handleGlobalKeydown.bind(this)

        // Add global keyboard listener
        document.addEventListener('keydown', this.handleGlobalKeydown)

        // Open if initially open
        if (this.openValue) {
            this.open()
        }
    }

    disconnect() {
        document.removeEventListener('keydown', this.handleGlobalKeydown)
        if (this.isOpen) {
            document.body.style.overflow = ''
        }
    }

    handleGlobalKeydown(event) {
        // Check for shortcut (Cmd/Ctrl + K by default)
        const modifierPressed = this.shortcutModifierValue === 'meta'
            ? event.metaKey
            : this.shortcutModifierValue === 'ctrl'
                ? event.ctrlKey
                : event.altKey

        if (modifierPressed && event.key.toLowerCase() === this.shortcutValue.toLowerCase()) {
            event.preventDefault()
            this.toggle()
        }

        // Escape to close
        if (event.key === 'Escape' && this.isOpen) {
            event.preventDefault()
            this.close()
        }
    }

    handleKeydown(event) {
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault()
                this.moveSelection(1)
                break
            case 'ArrowUp':
                event.preventDefault()
                this.moveSelection(-1)
                break
            case 'Enter':
                event.preventDefault()
                this.selectActive()
                break
            case 'Tab':
                event.preventDefault()
                if (event.shiftKey) {
                    this.moveSelection(-1)
                } else {
                    this.moveSelection(1)
                }
                break
        }
    }

    toggle() {
        if (this.isOpen) {
            this.close()
        } else {
            this.open()
        }
    }

    open() {
        if (this.isOpen) return

        this.isOpen = true
        this.previouslyFocusedElement = document.activeElement

        // Show modal
        this.modalTarget.style.display = 'block'

        // Animate in
        this.modalTarget.style.opacity = '0'
        this.modalTarget.offsetHeight // Force reflow

        this.modalTarget.style.transition = 'opacity 0.15s ease-out'
        this.modalTarget.style.opacity = '1'

        if (this.hasPanelTarget) {
            this.panelTarget.style.transform = 'scale(0.95) translateY(-10px)'
            this.panelTarget.style.opacity = '0'
            this.panelTarget.offsetHeight // Force reflow
            this.panelTarget.style.transition = 'transform 0.15s ease-out, opacity 0.15s ease-out'
            this.panelTarget.style.transform = 'scale(1) translateY(0)'
            this.panelTarget.style.opacity = '1'
        }

        // Prevent body scroll
        document.body.style.overflow = 'hidden'

        // Focus input
        requestAnimationFrame(() => {
            this.inputTarget.focus()
        })

        // Reset filter
        this.inputTarget.value = ''
        this.filter()

        // Reset selection
        this.activeIndex = 0
        this.updateActiveItem()

        // Dispatch event
        this.dispatch('opened')
    }

    close() {
        if (!this.isOpen) return

        this.isOpen = false

        // Animate out
        this.modalTarget.style.transition = 'opacity 0.1s ease-in'
        this.modalTarget.style.opacity = '0'

        if (this.hasPanelTarget) {
            this.panelTarget.style.transition = 'transform 0.1s ease-in, opacity 0.1s ease-in'
            this.panelTarget.style.transform = 'scale(0.95) translateY(-10px)'
            this.panelTarget.style.opacity = '0'
        }

        setTimeout(() => {
            if (!this.isOpen) {
                this.modalTarget.style.display = 'none'
                this.modalTarget.style.opacity = ''
                this.modalTarget.style.transition = ''

                if (this.hasPanelTarget) {
                    this.panelTarget.style.transform = ''
                    this.panelTarget.style.opacity = ''
                    this.panelTarget.style.transition = ''
                }
            }
        }, 100)

        // Restore body scroll
        document.body.style.overflow = ''

        // Restore focus
        if (this.previouslyFocusedElement) {
            this.previouslyFocusedElement.focus()
            this.previouslyFocusedElement = null
        }

        // Dispatch event
        this.dispatch('closed')
    }

    filter() {
        const query = this.inputTarget.value.toLowerCase().trim()
        let hasVisibleItems = false

        this.itemTargets.forEach(item => {
            const label = (item.dataset.label || '').toLowerCase()
            const value = (item.dataset.value || '').toLowerCase()
            const matches = !query || label.includes(query) || value.includes(query)

            item.style.display = matches ? '' : 'none'
            item.dataset.filtered = matches ? 'false' : 'true'

            if (matches) hasVisibleItems = true
        })

        // Update filtered items list
        this.filteredItems = this.itemTargets.filter(item => item.dataset.filtered !== 'true')

        // Show/hide groups based on visible items
        this.groupTargets.forEach(group => {
            const visibleItems = group.querySelectorAll('[data-cisse--ui-bundle--command-palette-target="item"]:not([style*="display: none"])')
            group.style.display = visibleItems.length > 0 ? '' : 'none'
        })

        // Show/hide empty state
        if (this.hasEmptyTarget) {
            this.emptyTarget.classList.toggle('hidden', hasVisibleItems)
        }
        if (this.hasResultsTarget) {
            this.resultsTarget.classList.toggle('hidden', !hasVisibleItems)
        }

        // Reset active index
        this.activeIndex = hasVisibleItems ? 0 : -1
        this.updateActiveItem()
    }

    moveSelection(direction) {
        if (this.filteredItems.length === 0) return

        this.activeIndex += direction

        // Wrap around
        if (this.activeIndex < 0) {
            this.activeIndex = this.filteredItems.length - 1
        } else if (this.activeIndex >= this.filteredItems.length) {
            this.activeIndex = 0
        }

        this.updateActiveItem()
        this.scrollActiveIntoView()
    }

    setActive(event) {
        const item = event.currentTarget
        const index = this.filteredItems.indexOf(item)
        if (index !== -1) {
            this.activeIndex = index
            this.updateActiveItem()
        }
    }

    updateActiveItem() {
        this.itemTargets.forEach((item, index) => {
            const isActive = this.filteredItems[this.activeIndex] === item
            item.dataset.active = isActive ? 'true' : 'false'
            item.setAttribute('aria-selected', isActive ? 'true' : 'false')
        })
    }

    scrollActiveIntoView() {
        const activeItem = this.filteredItems[this.activeIndex]
        if (activeItem && this.hasResultsTarget) {
            activeItem.scrollIntoView({ block: 'nearest', behavior: 'smooth' })
        }
    }

    selectActive() {
        const activeItem = this.filteredItems[this.activeIndex]
        if (activeItem && activeItem.dataset.disabled !== 'true') {
            this.selectItem(activeItem)
        }
    }

    select(event) {
        const item = event.currentTarget
        if (item.dataset.disabled === 'true') {
            event.preventDefault()
            return
        }
        this.selectItem(item)
    }

    selectItem(item) {
        const value = item.dataset.value
        const label = item.dataset.label

        // Dispatch select event
        this.dispatch('select', {
            detail: { value, label, item },
            cancelable: true
        })

        // Handle href navigation
        if (item.tagName === 'A' && item.href) {
            // Let the browser handle the navigation
            if (this.closeOnSelectValue) {
                this.close()
            }
            return
        }

        // Close if configured
        if (this.closeOnSelectValue) {
            this.close()
        }
    }
}
