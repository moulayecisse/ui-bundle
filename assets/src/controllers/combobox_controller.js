// assets/controllers/combobox_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["input", "trigger", "display", "chevron", "dropdown", "search", "options", "option", "noResults", "checkbox", "check"]
    static values = {
        multiple: { type: Boolean, default: false },
        options: { type: Array, default: [] }
    }

    connect() {
        this.isOpen = false
        this.selectedValues = this.parseInitialValue()
        this.updateDisplay()
        this.updateOptionStyles()

        // Close on outside click
        document.addEventListener('click', this.handleOutsideClick.bind(this))
    }

    disconnect() {
        document.removeEventListener('click', this.handleOutsideClick.bind(this))
    }

    parseInitialValue() {
        const value = this.inputTarget.value
        if (!value) return []

        if (this.multipleValue) {
            try {
                return JSON.parse(value)
            } catch {
                return []
            }
        }
        return [value]
    }

    toggle(event) {
        event.stopPropagation()
        if (this.isOpen) {
            this.close()
        } else {
            this.open()
        }
    }

    open() {
        this.isOpen = true
        this.dropdownTarget.classList.remove('hidden')
        this.chevronTarget.classList.add('rotate-180')
        this.searchTarget.focus()
        this.filter()
    }

    close() {
        this.isOpen = false
        this.dropdownTarget.classList.add('hidden')
        this.chevronTarget.classList.remove('rotate-180')
        this.searchTarget.value = ''
        this.filter()
    }

    handleOutsideClick(event) {
        if (!this.element.contains(event.target)) {
            this.close()
        }
    }

    filter() {
        const query = this.searchTarget.value.toLowerCase()
        let hasResults = false

        this.optionTargets.forEach(option => {
            const label = option.dataset.label.toLowerCase()
            const matches = label.includes(query)
            option.style.display = matches ? '' : 'none'
            if (matches) hasResults = true
        })

        this.noResultsTarget.classList.toggle('hidden', hasResults)
    }

    handleKeydown(event) {
        if (event.key === 'Escape') {
            this.close()
        }
    }

    select(event) {
        const button = event.currentTarget
        if (button.disabled) return

        const value = button.dataset.value

        if (this.multipleValue) {
            const index = this.selectedValues.indexOf(value)
            if (index === -1) {
                this.selectedValues.push(value)
            } else {
                this.selectedValues.splice(index, 1)
            }
            this.inputTarget.value = JSON.stringify(this.selectedValues)
        } else {
            this.selectedValues = [value]
            this.inputTarget.value = value
            this.close()
        }

        this.updateDisplay()
        this.updateOptionStyles()
        this.dispatch('change', { detail: { value: this.multipleValue ? this.selectedValues : value } })
    }

    clear(event) {
        event.stopPropagation()
        this.selectedValues = []
        this.inputTarget.value = this.multipleValue ? '[]' : ''
        this.updateDisplay()
        this.updateOptionStyles()
        this.dispatch('change', { detail: { value: this.multipleValue ? [] : null } })
    }

    updateDisplay() {
        if (this.selectedValues.length === 0) {
            this.displayTarget.textContent = this.displayTarget.dataset.placeholder || 'Select...'
            this.displayTarget.classList.add('text-gray-400', 'dark:text-gray-500')
            this.displayTarget.classList.remove('text-gray-900', 'dark:text-gray-100')
        } else {
            const labels = this.selectedValues.map(value => {
                const option = this.optionTargets.find(o => o.dataset.value === value)
                return option ? option.dataset.label : value
            })
            this.displayTarget.textContent = labels.join(', ')
            this.displayTarget.classList.remove('text-gray-400', 'dark:text-gray-500')
            this.displayTarget.classList.add('text-gray-900', 'dark:text-gray-100')
        }
    }

    updateOptionStyles() {
        this.optionTargets.forEach(option => {
            const value = option.dataset.value
            const isSelected = this.selectedValues.includes(value)

            // Update option background
            option.classList.toggle('bg-primary/10', isSelected && !this.multipleValue)
            option.classList.toggle('text-primary', isSelected && !this.multipleValue)
            option.classList.toggle('dark:bg-primary/20', isSelected && !this.multipleValue)

            // Update checkbox for multiple
            if (this.multipleValue) {
                const checkbox = option.querySelector('[data-cisse--ui-bundle--combobox-target="checkbox"]')
                if (checkbox) {
                    if (isSelected) {
                        checkbox.classList.add('border-primary', 'bg-primary', 'text-white')
                        checkbox.classList.remove('border-gray-300', 'dark:border-gray-600')
                        checkbox.innerHTML = '<svg class="size-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                    } else {
                        checkbox.classList.remove('border-primary', 'bg-primary', 'text-white')
                        checkbox.classList.add('border-gray-300', 'dark:border-gray-600')
                        checkbox.innerHTML = ''
                    }
                }
            } else {
                // Update check icon for single select
                const check = option.querySelector('[data-cisse--ui-bundle--combobox-target="check"]')
                if (check) {
                    check.classList.toggle('hidden', !isSelected)
                }
            }
        })
    }
}
