// assets/controllers/icon_picker_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = [
        "input", "display", "placeholder", "selectedIcon", "selectedName",
        "clearButton", "backdrop", "modal", "search", "loader", "grid",
        "noResults", "count"
    ]
    static values = {
        collections: { type: String, default: "mdi,heroicons,lucide" },
        limit: { type: Number, default: 48 },
        popularIcons: { type: Array, default: [] }
    }

    connect() {
        this.searchTimeout = null
        this.isOpen = false
    }

    open(event) {
        event.preventDefault()
        event.stopPropagation()

        if (this.element.querySelector('button[disabled]')) return

        this.isOpen = true
        this.backdropTarget.classList.remove('hidden')
        this.modalTarget.classList.remove('hidden')
        this.searchTarget.focus()
    }

    close() {
        this.isOpen = false
        this.backdropTarget.classList.add('hidden')
        this.modalTarget.classList.add('hidden')
        this.searchTarget.value = ''
        this.resetGrid()
    }

    search() {
        const query = this.searchTarget.value.trim()

        // Clear previous timeout
        if (this.searchTimeout) {
            clearTimeout(this.searchTimeout)
        }

        if (!query || query.length < 2) {
            this.resetGrid()
            return
        }

        // Debounce the search
        this.searchTimeout = setTimeout(() => {
            this.performSearch(query)
        }, 300)
    }

    async performSearch(query) {
        this.loaderTarget.classList.remove('hidden')
        this.noResultsTarget.classList.add('hidden')

        try {
            const url = `https://api.iconify.design/search?query=${encodeURIComponent(query)}&limit=${this.limitValue}&prefixes=${this.collectionsValue}`
            const response = await fetch(url)
            const data = await response.json()

            this.renderIcons(data.icons || [])
            this.countTarget.textContent = `${(data.icons || []).length} results`
        } catch (error) {
            console.error('Failed to search icons:', error)
            this.noResultsTarget.classList.remove('hidden')
            this.noResultsTarget.textContent = 'Failed to search icons'
        } finally {
            this.loaderTarget.classList.add('hidden')
        }
    }

    renderIcons(icons) {
        if (icons.length === 0) {
            this.noResultsTarget.classList.remove('hidden')
            this.noResultsTarget.textContent = `No icons found for "${this.searchTarget.value}"`
            this.gridTarget.innerHTML = ''
            return
        }

        this.noResultsTarget.classList.add('hidden')

        // Create icon buttons
        const currentValue = this.inputTarget.value
        this.gridTarget.innerHTML = icons.map(icon => {
            const isSelected = icon === currentValue
            const selectedClass = isSelected ? 'bg-primary text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300'

            return `
                <button
                    type="button"
                    data-action="click->cisse--ui-bundle--icon-picker#select"
                    data-icon="${icon}"
                    class="icon-button flex size-9 items-center justify-center rounded transition-colors ${selectedClass}"
                    title="${icon}"
                >
                    <span class="iconify size-5" data-icon="${icon}"></span>
                </button>
            `
        }).join('')

        // Load iconify icons if available
        if (window.Iconify) {
            window.Iconify.scan()
        }
    }

    resetGrid() {
        this.noResultsTarget.classList.add('hidden')
        this.countTarget.textContent = 'Popular icons'

        // Restore popular icons
        const currentValue = this.inputTarget.value
        this.gridTarget.innerHTML = this.popularIconsValue.map(icon => {
            const isSelected = icon === currentValue
            const selectedClass = isSelected ? 'bg-primary text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300'

            return `
                <button
                    type="button"
                    data-action="click->cisse--ui-bundle--icon-picker#select"
                    data-icon="${icon}"
                    class="icon-button flex size-9 items-center justify-center rounded transition-colors ${selectedClass}"
                    title="${icon}"
                >
                    <span class="iconify size-5" data-icon="${icon}"></span>
                </button>
            `
        }).join('')

        if (window.Iconify) {
            window.Iconify.scan()
        }
    }

    select(event) {
        event.preventDefault()
        const icon = event.currentTarget.dataset.icon

        this.inputTarget.value = icon
        this.updateDisplay(icon)
        this.close()

        this.dispatch('change', { detail: { icon } })
    }

    clear(event) {
        event.preventDefault()
        event.stopPropagation()

        this.inputTarget.value = ''
        this.updateDisplay('')

        this.dispatch('change', { detail: { icon: '' } })
    }

    updateDisplay(icon) {
        if (icon) {
            this.displayTarget.classList.remove('hidden')
            this.placeholderTarget.classList.add('hidden')
            this.clearButtonTarget.classList.remove('hidden')
            this.selectedNameTarget.textContent = icon

            // Update the icon - this requires the icon to be available
            // For Symfony UX Icons, we need to update the data-icon attribute
            if (this.hasSelectedIconTarget) {
                this.selectedIconTarget.setAttribute('data-icon', icon)
                if (window.Iconify) {
                    window.Iconify.scan(this.selectedIconTarget.parentElement)
                }
            }
        } else {
            this.displayTarget.classList.add('hidden')
            this.placeholderTarget.classList.remove('hidden')
            this.clearButtonTarget.classList.add('hidden')
        }
    }
}
