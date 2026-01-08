// assets/controllers/mobile_list_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item", "itemCheckbox", "selectAllCheckbox", "selectedCount"]
    static values = {
        selectable: { type: Boolean, default: false }
    }

    connect() {
        this.selected = []
        this.updateSelectionUI()
    }

    selectItem(event) {
        const checkbox = event.currentTarget
        const itemId = checkbox.value

        if (checkbox.checked) {
            if (!this.selected.includes(itemId)) {
                this.selected.push(itemId)
            }
        } else {
            this.selected = this.selected.filter(id => id !== itemId)
        }

        this.updateSelectionUI()
        this.dispatchSelectionEvent()
    }

    selectAll(event) {
        const selectAllCheckbox = event.currentTarget

        if (selectAllCheckbox.checked) {
            this.selected = this.itemCheckboxTargets.map(cb => cb.value)
        } else {
            this.selected = []
        }

        this.updateSelectionUI()
        this.dispatchSelectionEvent()
    }

    updateSelectionUI() {
        // Update individual checkboxes
        this.itemCheckboxTargets.forEach(checkbox => {
            const itemId = checkbox.value
            checkbox.checked = this.selected.includes(itemId)
        })

        // Update select all checkbox
        if (this.hasSelectAllCheckboxTarget) {
            const totalCheckboxes = this.itemCheckboxTargets.length
            const selectedCount = this.selected.length

            if (selectedCount === 0) {
                this.selectAllCheckboxTarget.checked = false
                this.selectAllCheckboxTarget.indeterminate = false
            } else if (selectedCount === totalCheckboxes) {
                this.selectAllCheckboxTarget.checked = true
                this.selectAllCheckboxTarget.indeterminate = false
            } else {
                this.selectAllCheckboxTarget.checked = false
                this.selectAllCheckboxTarget.indeterminate = true
            }
        }

        // Update item card styling
        this.itemTargets.forEach(item => {
            const itemId = item.dataset.itemId
            if (this.selected.includes(itemId)) {
                item.classList.add('ring-2', 'ring-primary')
            } else {
                item.classList.remove('ring-2', 'ring-primary')
            }
        })

        // Update selected count
        if (this.hasSelectedCountTarget) {
            if (this.selected.length > 0) {
                this.selectedCountTarget.textContent = `(${this.selected.length} selected)`
                this.selectedCountTarget.classList.remove('hidden')
            } else {
                this.selectedCountTarget.classList.add('hidden')
            }
        }
    }

    dispatchSelectionEvent() {
        this.dispatch('selection-changed', {
            detail: {
                selected: [...this.selected],
                count: this.selected.length
            }
        })
    }

    getSelected() {
        return [...this.selected]
    }

    clearSelection() {
        this.selected = []
        this.updateSelectionUI()
        this.dispatchSelectionEvent()
    }
}
