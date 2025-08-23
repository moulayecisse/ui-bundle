import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item", "content", "icon"]

    connect() {
        this.activeIndex = null
        this.initializeItems()
    }

    initializeItems() {
        // Hide all content initially
        this.contentTargets.forEach((content, index) => {
            content.style.display = 'none'
        })
    }

    toggle(event) {
        const button = event.currentTarget
        const item = button.closest('[data-cisse--ui-bundle--accordion-target="item"]')
        const itemIndex = this.itemTargets.indexOf(item)

        if (itemIndex === -1) return

        // Toggle the item
        if (this.activeIndex === itemIndex) {
            this.closeItem(itemIndex)
            this.activeIndex = null
        } else {
            // Close currently active item
            if (this.activeIndex !== null) {
                this.closeItem(this.activeIndex)
            }
            // Open new item
            this.openItem(itemIndex)
            this.activeIndex = itemIndex
        }
    }

    openItem(index) {
        const content = this.contentTargets[index]
        const icon = this.iconTargets[index]

        // Show content
        content.style.display = 'block'
        content.style.maxHeight = '0px'
        content.style.overflow = 'hidden'
        content.style.transition = 'max-height 0.3s ease-out'

        // Force reflow
        content.offsetHeight

        // Animate to full height
        content.style.maxHeight = content.scrollHeight + 'px'

        // Update icon
        if (icon) {
            icon.dataset.open = 'true'
        }

        // Clean up after animation
        setTimeout(() => {
            if (content.style.maxHeight !== '0px') {
                content.style.maxHeight = 'none'
                content.style.overflow = 'visible'
            }
        }, 300)
    }

    closeItem(index) {
        const content = this.contentTargets[index]
        const icon = this.iconTargets[index]

        // Set current height
        content.style.maxHeight = content.scrollHeight + 'px'
        content.style.overflow = 'hidden'
        content.style.transition = 'max-height 0.3s ease-in'

        // Force reflow
        content.offsetHeight

        // Animate to 0 height
        content.style.maxHeight = '0px'

        // Update icon
        if (icon) {
            icon.dataset.open = 'false'
        }

        // Hide after animation
        setTimeout(() => {
            if (content.style.maxHeight === '0px') {
                content.style.display = 'none'
            }
        }, 300)
    }
}