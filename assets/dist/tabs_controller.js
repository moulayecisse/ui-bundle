// assets/controllers/tabs_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item"]
    static values = {
        current: String
    }

    connect() {
        this.initializeTabs()
    }

    initializeTabs() {
        // Update all tabs based on current value
        this.itemTargets.forEach(item => {
            const href = item.dataset.href || item.getAttribute('href')
            const isCurrent = this.shouldBeActive(item)
            
            item.dataset.current = isCurrent ? 'true' : 'false'
            
            // Update ARIA attributes for accessibility
            item.setAttribute('role', 'tab')
            item.setAttribute('aria-selected', isCurrent ? 'true' : 'false')
        })

        // Set up keyboard navigation
        this.setupKeyboardNavigation()
    }

    shouldBeActive(item) {
        // Check if this tab should be active based on various conditions
        const itemCurrent = item.dataset.current === 'true'
        const href = item.dataset.href || item.getAttribute('href')
        
        // Match against current value if provided
        if (this.currentValue) {
            return href === this.currentValue || 
                   item.dataset.key === this.currentValue ||
                   item.textContent.trim().toLowerCase() === this.currentValue.toLowerCase()
        }
        
        // Fall back to existing current state
        return itemCurrent
    }

    select(event) {
        const item = event.currentTarget
        
        // Skip if disabled
        if (item.dataset.disabled === 'true') {
            event.preventDefault()
            return
        }

        const wasSelected = item.dataset.current === 'true'
        
        // Don't prevent default for actual navigation
        // Just update the visual state and dispatch event
        this.setActiveTab(item)

        // Dispatch selection event
        this.dispatch('selected', {
            detail: {
                item: item,
                href: item.dataset.href || item.getAttribute('href'),
                text: item.textContent.trim(),
                wasSelected: wasSelected
            }
        })
    }

    setActiveTab(activeItem) {
        // Update all tabs
        this.itemTargets.forEach(item => {
            const isActive = item === activeItem
            
            item.dataset.current = isActive ? 'true' : 'false'
            item.setAttribute('aria-selected', isActive ? 'true' : 'false')
        })

        // Update controller's current value
        const href = activeItem.dataset.href || activeItem.getAttribute('href')
        this.currentValue = href
        this.element.dataset.current = href
    }

    setupKeyboardNavigation() {
        this.itemTargets.forEach((item, index) => {
            item.setAttribute('tabindex', item.dataset.current === 'true' ? '0' : '-1')
            
            item.addEventListener('keydown', (event) => {
                switch (event.key) {
                    case 'ArrowLeft':
                    case 'ArrowUp':
                        event.preventDefault()
                        this.focusPrevious(index)
                        break
                    case 'ArrowRight':
                    case 'ArrowDown':
                        event.preventDefault()
                        this.focusNext(index)
                        break
                    case 'Home':
                        event.preventDefault()
                        this.focusFirst()
                        break
                    case 'End':
                        event.preventDefault()
                        this.focusLast()
                        break
                    case 'Enter':
                    case ' ':
                        event.preventDefault()
                        item.click()
                        break
                }
            })
        })
    }

    focusPrevious(currentIndex) {
        const enabledItems = this.itemTargets.filter(item => item.dataset.disabled !== 'true')
        const currentEnabledIndex = enabledItems.findIndex(item => 
            this.itemTargets.indexOf(item) === currentIndex
        )
        
        if (currentEnabledIndex > 0) {
            const previousItem = enabledItems[currentEnabledIndex - 1]
            this.focusItem(previousItem)
        } else if (enabledItems.length > 0) {
            // Wrap to last
            this.focusItem(enabledItems[enabledItems.length - 1])
        }
    }

    focusNext(currentIndex) {
        const enabledItems = this.itemTargets.filter(item => item.dataset.disabled !== 'true')
        const currentEnabledIndex = enabledItems.findIndex(item => 
            this.itemTargets.indexOf(item) === currentIndex
        )
        
        if (currentEnabledIndex < enabledItems.length - 1) {
            const nextItem = enabledItems[currentEnabledIndex + 1]
            this.focusItem(nextItem)
        } else if (enabledItems.length > 0) {
            // Wrap to first
            this.focusItem(enabledItems[0])
        }
    }

    focusFirst() {
        const enabledItems = this.itemTargets.filter(item => item.dataset.disabled !== 'true')
        if (enabledItems.length > 0) {
            this.focusItem(enabledItems[0])
        }
    }

    focusLast() {
        const enabledItems = this.itemTargets.filter(item => item.dataset.disabled !== 'true')
        if (enabledItems.length > 0) {
            this.focusItem(enabledItems[enabledItems.length - 1])
        }
    }

    focusItem(item) {
        // Update tabindex for all items
        this.itemTargets.forEach(tabItem => {
            tabItem.setAttribute('tabindex', tabItem === item ? '0' : '-1')
        })
        
        // Focus the item
        item.focus()
    }

    currentValueChanged() {
        this.initializeTabs()
    }

    // Public API methods
    selectTab(index) {
        const item = this.itemTargets[index]
        if (item && item.dataset.disabled !== 'true') {
            this.setActiveTab(item)
        }
    }

    selectTabByHref(href) {
        const item = this.itemTargets.find(item => {
            const itemHref = item.dataset.href || item.getAttribute('href')
            return itemHref === href
        })
        
        if (item && item.dataset.disabled !== 'true') {
            this.setActiveTab(item)
        }
    }

    enableTab(index) {
        const item = this.itemTargets[index]
        if (item) {
            item.dataset.disabled = 'false'
            item.removeAttribute('aria-disabled')
            item.setAttribute('tabindex', item.dataset.current === 'true' ? '0' : '-1')
        }
    }

    disableTab(index) {
        const item = this.itemTargets[index]
        if (item) {
            item.dataset.disabled = 'true'
            item.setAttribute('aria-disabled', 'true')
            item.setAttribute('tabindex', '-1')
        }
    }
}