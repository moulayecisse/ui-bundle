// assets/controllers/selectable_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = [
        "batchActions",
        "selectAllCheckbox",
        "selectCheckbox",
        "selectIndicator",
        "expandButton",
        "expandRow",
        "expandIcon",
        "bulkForm",
        "idsInput"
    ]
    static values = {
        selectable: { type: Boolean, default: false },
        expandable: { type: Boolean, default: false }
    }

    connect() {
        this.selected = []
        this.expanded = []
        this.initializeTable()
    }

    initializeTable() {
        // Initialize selection state
        if (this.selectableValue) {
            this.updateSelectionUI()
        }

        // Initialize expansion state
        if (this.expandableValue) {
            this.updateExpansionUI()
        }
    }

    // Selection Methods
    selectItem(event) {
        const checkbox = event.currentTarget
        const itemId = parseInt(checkbox.value)

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
            // Select all items
            this.selected = this.selectCheckboxTargets.map(cb => parseInt(cb.value))
        } else {
            // Deselect all items
            this.selected = []
        }

        this.updateSelectionUI()
        this.dispatchSelectionEvent()
    }

    updateSelectionUI() {
        // Update individual checkboxes
        this.selectCheckboxTargets.forEach(checkbox => {
            const itemId = parseInt(checkbox.value)
            checkbox.checked = this.selected.includes(itemId)
        })

        // Update select all checkbox
        if (this.hasSelectAllCheckboxTarget) {
            const totalCheckboxes = this.selectCheckboxTargets.length
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

        // Update selection indicators (colored bars)
        this.selectIndicatorTargets.forEach(indicator => {
            const itemId = parseInt(indicator.dataset.itemId)
            if (this.selected.includes(itemId)) {
                indicator.style.display = 'block'
            } else {
                indicator.style.display = 'none'
            }
        })

        // Update row backgrounds
        this.selectCheckboxTargets.forEach(checkbox => {
            const itemId = parseInt(checkbox.value)
            const row = checkbox.closest('tr')

            if (this.selected.includes(itemId)) {
                row.classList.add('bg-slate-50', 'dark:bg-slate-900')
            } else {
                row.classList.remove('bg-slate-50', 'dark:bg-slate-900')
            }
        })

        // Show/hide batch actions
        if (this.hasBatchActionsTarget) {
            if (this.selected.length > 0) {
                this.batchActionsTarget.style.display = 'flex'
            } else {
                this.batchActionsTarget.style.display = 'none'
            }
        }

        // Update bulk form hidden input if present
        this.updateBulkFormIds()
    }

    dispatchSelectionEvent() {
        this.dispatch('selection-changed', {
            detail: {
                selected: [...this.selected],
                count: this.selected.length
            }
        })
    }

    // Expansion Methods
    expandItem(event) {
        const button = event.currentTarget
        const itemId = parseInt(button.dataset.itemId)

        if (this.expanded.includes(itemId)) {
            // Collapse item
            this.expanded = this.expanded.filter(id => id !== itemId)
            this.collapseRow(itemId)
        } else {
            // Expand item
            this.expanded.push(itemId)
            this.expandRow(itemId)
        }

        this.updateExpansionUI()
        this.dispatchExpansionEvent(itemId)
    }

    expandRow(itemId) {
        const expandRow = this.expandRowTargets.find(row =>
            parseInt(row.dataset.itemId) === itemId
        )

        if (expandRow) {
            const content = expandRow.querySelector('.expand-content')

            // Show the row
            expandRow.style.display = 'table-row'

            // Animate the content
            if (content) {
                content.style.display = 'block'
                content.style.maxHeight = '0px'
                content.style.overflow = 'hidden'
                content.style.transition = 'max-height 0.3s ease-out'

                // Force reflow
                content.offsetHeight

                content.style.maxHeight = content.scrollHeight + 'px'

                // Clean up after animation
                setTimeout(() => {
                    if (content.style.maxHeight !== '0px') {
                        content.style.maxHeight = 'none'
                        content.style.overflow = 'visible'
                    }
                }, 300)
            }
        }
    }

    collapseRow(itemId) {
        const expandRow = this.expandRowTargets.find(row =>
            parseInt(row.dataset.itemId) === itemId
        )

        if (expandRow) {
            const content = expandRow.querySelector('.expand-content')

            if (content) {
                content.style.maxHeight = content.scrollHeight + 'px'
                content.style.overflow = 'hidden'
                content.style.transition = 'max-height 0.3s ease-in'

                // Force reflow
                content.offsetHeight

                content.style.maxHeight = '0px'

                // Hide row after animation
                setTimeout(() => {
                    if (content.style.maxHeight === '0px') {
                        expandRow.style.display = 'none'
                        content.style.maxHeight = ''
                        content.style.overflow = ''
                        content.style.transition = ''
                    }
                }, 300)
            } else {
                expandRow.style.display = 'none'
            }
        }
    }

    updateExpansionUI() {
        // Update expand icons
        this.expandIconTargets.forEach(icon => {
            const itemId = parseInt(icon.dataset.itemId)

            if (this.expanded.includes(itemId)) {
                icon.classList.add('rotate-180')
                icon.classList.remove('rotate-0')
            } else {
                icon.classList.add('rotate-0')
                icon.classList.remove('rotate-180')
            }
        })
    }

    dispatchExpansionEvent(itemId) {
        const isExpanded = this.expanded.includes(itemId)

        this.dispatch('expansion-changed', {
            detail: {
                itemId: itemId,
                expanded: isExpanded,
                allExpanded: [...this.expanded]
            }
        })
    }

    // Public API Methods
    selectItems(itemIds) {
        this.selected = [...itemIds]
        this.updateSelectionUI()
        this.dispatchSelectionEvent()
    }

    deselectAll() {
        this.selected = []
        this.updateSelectionUI()
        this.dispatchSelectionEvent()
    }

    getSelected() {
        return [...this.selected]
    }

    expandItems(itemIds) {
        itemIds.forEach(itemId => {
            if (!this.expanded.includes(itemId)) {
                this.expanded.push(itemId)
                this.expandRow(itemId)
            }
        })
        this.updateExpansionUI()
    }

    collapseAll() {
        const toCollapse = [...this.expanded]
        this.expanded = []

        toCollapse.forEach(itemId => {
            this.collapseRow(itemId)
        })

        this.updateExpansionUI()
    }

    getExpanded() {
        return [...this.expanded]
    }

    // Bulk Form Methods
    updateBulkFormIds() {
        if (this.hasIdsInputTarget) {
            this.idsInputTarget.value = JSON.stringify(this.selected)
        }
    }

    handleBulkSubmit(event) {
        if (this.selected.length === 0) {
            event.preventDefault()
            event.stopPropagation()

            // Dispatch custom event for empty selection
            this.dispatch('bulk-submit-empty', {
                detail: { message: 'No items selected' }
            })

            return false
        }

        // Dispatch event with selected items before submission
        this.dispatch('bulk-submit', {
            detail: {
                selected: [...this.selected],
                count: this.selected.length
            }
        })

        return true
    }
}