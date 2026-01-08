// assets/controllers/dark_mode_toggle_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["lightIcon", "darkIcon", "label"]
    static values = {
        storageKey: { type: String, default: 'dark-mode' }
    }

    connect() {
        this.initializeDarkMode()
    }

    initializeDarkMode() {
        // Check localStorage first, then system preference
        const stored = localStorage.getItem(this.storageKeyValue)

        if (stored === 'true') {
            this.enableDarkMode()
        } else if (stored === 'false') {
            this.disableDarkMode()
        } else {
            // Check system preference
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                this.enableDarkMode()
            }
        }

        this.updateLabel()
    }

    toggle() {
        const isDark = document.documentElement.classList.contains('dark')

        if (isDark) {
            this.disableDarkMode()
        } else {
            this.enableDarkMode()
        }

        this.updateLabel()
        this.dispatch('toggle', { detail: { dark: !isDark } })
    }

    enableDarkMode() {
        document.documentElement.classList.add('dark')
        localStorage.setItem(this.storageKeyValue, 'true')
    }

    disableDarkMode() {
        document.documentElement.classList.remove('dark')
        localStorage.setItem(this.storageKeyValue, 'false')
    }

    updateLabel() {
        if (this.hasLabelTarget) {
            const isDark = document.documentElement.classList.contains('dark')
            this.labelTarget.textContent = isDark ? 'Dark' : 'Light'
        }
    }

    get isDark() {
        return document.documentElement.classList.contains('dark')
    }
}
