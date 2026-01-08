// assets/controllers/collapsible_card_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["content", "icon"]
    static values = {
        expanded: { type: Boolean, default: true }
    }

    connect() {
        this.updateState(false)
    }

    toggle() {
        this.expandedValue = !this.expandedValue
        this.updateState(true)
        this.dispatch('toggle', { detail: { expanded: this.expandedValue } })
    }

    updateState(animate = true) {
        const content = this.contentTarget
        const icon = this.hasIconTarget ? this.iconTarget : null

        if (this.expandedValue) {
            // Expand
            if (animate) {
                content.style.maxHeight = content.scrollHeight + 'px'
                content.style.opacity = '1'
            } else {
                content.style.maxHeight = ''
                content.style.opacity = ''
            }

            if (icon) {
                // Update icon to chevron-up
                icon.setAttribute('data-icon', 'heroicons:chevron-up-20-solid')
                icon.classList.remove('rotate-180')
            }
        } else {
            // Collapse
            if (animate) {
                content.style.maxHeight = '0'
                content.style.opacity = '0'
            } else {
                content.style.maxHeight = '0'
                content.style.opacity = '0'
            }

            if (icon) {
                // Update icon to chevron-down
                icon.setAttribute('data-icon', 'heroicons:chevron-down-20-solid')
                icon.classList.add('rotate-180')
            }
        }
    }

    expandedValueChanged() {
        this.updateState(true)
    }
}
