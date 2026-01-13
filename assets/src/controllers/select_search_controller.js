import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["select", "input"]
    static values = {
        placeholders: Object, // { "optionValue": "placeholder text" }
        baseUrl: String // Base URL for path-based form submission
    }

    connect() {
        this.updatePlaceholder()
    }

    updatePlaceholder() {
        if (!this.hasInputTarget || !this.hasSelectTarget) return

        const selectedValue = this.selectTarget.value
        const placeholders = this.placeholdersValue || {}

        // Use the placeholder for the selected value, or a default
        const placeholder = placeholders[selectedValue] || this.inputTarget.dataset.defaultPlaceholder || 'Search...'
        this.inputTarget.placeholder = placeholder
    }

    selectChanged() {
        this.updatePlaceholder()
        this.dispatch('change', { detail: { value: this.selectTarget.value } })
    }

    submit(event) {
        // If baseUrl is set, use path-based navigation instead of query params
        if (this.hasBaseUrlValue && this.baseUrlValue) {
            event.preventDefault()

            const type = this.selectTarget.value
            const identifier = this.inputTarget.value.trim()

            if (identifier) {
                window.location.href = `${this.baseUrlValue}/${type}/${encodeURIComponent(identifier)}`
            }
        }
    }
}
