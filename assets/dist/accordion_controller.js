// assets/controllers/accordion_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item", "content", "icon", "button"]
    static values = {
        active: Number,
        multiple: { type: Boolean, default: false },
        duration: { type: Number, default: 300 },
        easing: { type: String, default: "ease-out" }
    }

    connect() {
        this.activeItems = this.multipleValue ? [] : null
        this.initializeItems()
        this.setInitialActive()
    }

    initializeItems() {
        // Hide all content initially and set up accessibility
        this.contentTargets.forEach((content, index) => {
            content.style.display = 'none'

            // Set up ARIA attributes
            const button = this.buttonTargets[index]
            if (button) {
                button.setAttribute('aria-expanded', 'false')
                button.setAttribute('aria-controls', `accordion-content-${index}`)
                content.setAttribute('id', `accordion-content-${index}`)
                content.setAttribute('role', 'region')
                content.setAttribute('aria-labelledby', `accordion-button-${index}`)
                button.setAttribute('id', `accordion-button-${index}`)
            }
        })
    }

    setInitialActive() {
        if (this.hasActiveValue && this.activeValue >= 0) {
            if (this.multipleValue) {
                this.activeItems = [this.activeValue]
            } else {
                this.activeItems = this.activeValue
            }

            // Open the initial active item without animation
            if (this.multipleValue) {
                this.activeItems.forEach(index => {
                    this.openItem(index, false)
                })
            } else {
                this.openItem(this.activeItems, false)
            }
        }
    }

    toggle(event) {
        const button = event.currentTarget
        const item = button.closest('[data-cisse--ui-bundle--accordion-target="item"]')
        const itemIndex = this.itemTargets.indexOf(item)

        if (itemIndex === -1) return

        // Check if item is disabled
        if (button.hasAttribute('disabled') || button.dataset.disabled === 'true') {
            return
        }

        if (this.multipleValue) {
            this.toggleMultiple(itemIndex)
        } else {
            this.toggleSingle(itemIndex)
        }

        // Dispatch custom event
        this.dispatch('toggled', {
            detail: {
                index: itemIndex,
                active: this.isItemActive(itemIndex),
                activeItems: this.multipleValue ? [...this.activeItems] : this.activeItems
            }
        })
    }

    toggleSingle(itemIndex) {
        if (this.activeItems === itemIndex) {
            this.closeItem(itemIndex)
            this.activeItems = null
        } else {
            if (this.activeItems !== null) {
                this.closeItem(this.activeItems)
            }
            this.openItem(itemIndex)
            this.activeItems = itemIndex
        }
    }

    toggleMultiple(itemIndex) {
        if (this.activeItems.includes(itemIndex)) {
            this.closeItem(itemIndex)
            this.activeItems = this.activeItems.filter(i => i !== itemIndex)
        } else {
            this.openItem(itemIndex)
            this.activeItems.push(itemIndex)
        }
    }

    isItemActive(index) {
        if (this.multipleValue) {
            return this.activeItems.includes(index)
        } else {
            return this.activeItems === index
        }
    }

    openItem(index, animate = true) {
        const content = this.contentTargets[index]
        const icon = this.iconTargets[index]
        const button = this.buttonTargets[index]

        content.style.display = 'block'

        if (animate) {
            content.style.maxHeight = '0px'
            content.style.overflow = 'hidden'
            content.style.transition = `max-height ${this.durationValue}ms ${this.easingValue}`

            content.offsetHeight // Force reflow

            content.style.maxHeight = content.scrollHeight + 'px'
        } else {
            content.style.maxHeight = 'none'
            content.style.overflow = 'visible'
        }

        // Update icon and button states
        if (icon) {
            icon.dataset.open = 'true'
            icon.classList.add('rotate-180')
            icon.classList.remove('rotate-0')
        }

        if (button) {
            button.setAttribute('aria-expanded', 'true')
        }

        // Clean up after animation
        if (animate) {
            setTimeout(() => {
                if (content.style.maxHeight !== '0px') {
                    content.style.maxHeight = 'none'
                    content.style.overflow = 'visible'
                }
            }, this.durationValue)
        }
    }

    closeItem(index, animate = true) {
        const content = this.contentTargets[index]
        const icon = this.iconTargets[index]
        const button = this.buttonTargets[index]

        if (animate) {
            content.style.maxHeight = content.scrollHeight + 'px'
            content.style.overflow = 'hidden'
            content.style.transition = `max-height ${this.durationValue}ms ease-in`

            content.offsetHeight // Force reflow

            content.style.maxHeight = '0px'
        } else {
            content.style.display = 'none'
        }

        // Update icon and button states
        if (icon) {
            icon.dataset.open = 'false'
            icon.classList.add('rotate-0')
            icon.classList.remove('rotate-180')
        }

        if (button) {
            button.setAttribute('aria-expanded', 'false')
        }

        // Hide after animation
        if (animate) {
            setTimeout(() => {
                if (content.style.maxHeight === '0px') {
                    content.style.display = 'none'
                }
            }, this.durationValue)
        }
    }

    // Keyboard navigation
    keydown(event) {
        const button = event.target
        if (!button.matches('[data-action*="keydown->"]')) return

        const item = button.closest('[data-cisse--ui-bundle--accordion-target="item"]')
        const itemIndex = this.itemTargets.indexOf(item)

        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault()
                this.focusNextButton(itemIndex)
                break
            case 'ArrowUp':
                event.preventDefault()
                this.focusPreviousButton(itemIndex)
                break
            case 'Home':
                event.preventDefault()
                this.focusFirstButton()
                break
            case 'End':
                event.preventDefault()
                this.focusLastButton()
                break
        }
    }

    focusNextButton(currentIndex) {
        const nextIndex = (currentIndex + 1) % this.buttonTargets.length
        this.buttonTargets[nextIndex].focus()
    }

    focusPreviousButton(currentIndex) {
        const prevIndex = currentIndex === 0 ? this.buttonTargets.length - 1 : currentIndex - 1
        this.buttonTargets[prevIndex].focus()
    }

    focusFirstButton() {
        this.buttonTargets[0].focus()
    }

    focusLastButton() {
        this.buttonTargets[this.buttonTargets.length - 1].focus()
    }

    // Public API methods
    openAll() {
        if (!this.multipleValue) return

        this.itemTargets.forEach((_, index) => {
            if (!this.isItemActive(index)) {
                this.openItem(index)
                this.activeItems.push(index)
            }
        })
    }

    closeAll() {
        if (this.multipleValue) {
            [...this.activeItems].forEach(index => {
                this.closeItem(index)
            })
            this.activeItems = []
        } else if (this.activeItems !== null) {
            this.closeItem(this.activeItems)
            this.activeItems = null
        }
    }

    showItem(index) {
        if (this.multipleValue) {
            if (!this.activeItems.includes(index)) {
                this.openItem(index)
                this.activeItems.push(index)
            }
        } else {
            if (this.activeItems !== null) {
                this.closeItem(this.activeItems)
            }
            this.openItem(index)
            this.activeItems = index
        }
    }
}