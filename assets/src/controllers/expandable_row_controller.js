// assets/controllers/expandable_row_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["content", "icon"]
    static values = {
        expanded: { type: Boolean, default: false }
    }

    connect() {
        this.updateState(false)
    }

    toggle() {
        this.expandedValue = !this.expandedValue
        this.updateState(true)
        this.dispatch('toggle', { detail: { expanded: this.expandedValue } })
    }

    expand() {
        if (!this.expandedValue) {
            this.expandedValue = true
            this.updateState(true)
            this.dispatch('toggle', { detail: { expanded: this.expandedValue } })
        }
    }

    collapse() {
        if (this.expandedValue) {
            this.expandedValue = false
            this.updateState(true)
            this.dispatch('toggle', { detail: { expanded: this.expandedValue } })
        }
    }

    updateState(animate = true) {
        const content = this.contentTarget
        const icon = this.hasIconTarget ? this.iconTarget : null

        if (this.expandedValue) {
            // Expand
            content.style.display = ''
            content.classList.remove('hidden')

            if (icon) {
                icon.classList.add('rotate-90')
            }
        } else {
            // Collapse
            content.style.display = 'none'
            content.classList.add('hidden')

            if (icon) {
                icon.classList.remove('rotate-90')
            }
        }
    }

    expandedValueChanged() {
        this.updateState(true)
    }
}
