// assets/controllers/filter_tabs_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["input", "tab"]

    connect() {
        this.updateTabStyles()
    }

    select(event) {
        const button = event.currentTarget
        if (button.disabled) return

        const value = button.dataset.value
        this.inputTarget.value = value

        this.updateTabStyles()

        this.dispatch('change', { detail: { value } })
    }

    updateTabStyles() {
        const currentValue = this.inputTarget.value

        this.tabTargets.forEach(tab => {
            const isSelected = tab.dataset.value === currentValue
            const variant = this.detectVariant(tab)

            // Remove all state classes first
            tab.classList.remove(
                'bg-primary-500', 'text-white', 'shadow-md',
                'bg-white', 'dark:bg-slate-700', 'shadow-sm',
                'border-primary-500', 'text-primary-600', 'dark:text-primary-400',
                'border-transparent', 'text-gray-500', 'dark:text-gray-400',
                'text-gray-600', 'text-gray-900', 'dark:text-white'
            )

            if (variant === 'pills') {
                if (isSelected) {
                    tab.classList.add('bg-primary-500', 'text-white', 'shadow-md')
                } else {
                    tab.classList.add('text-gray-600', 'dark:text-gray-400')
                }
            } else if (variant === 'underline') {
                if (isSelected) {
                    tab.classList.add('border-primary-500', 'text-primary-600', 'dark:text-primary-400')
                } else {
                    tab.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400')
                }
            } else if (variant === 'boxed') {
                if (isSelected) {
                    tab.classList.add('bg-white', 'dark:bg-slate-700', 'text-gray-900', 'dark:text-white', 'shadow-sm')
                } else {
                    tab.classList.add('text-gray-600', 'dark:text-gray-400')
                }
            }

            // Update count badge styling
            const countBadge = tab.querySelector('span:last-child')
            if (countBadge && countBadge.classList.contains('rounded-full')) {
                this.updateCountBadge(countBadge, isSelected, variant)
            }
        })
    }

    detectVariant(tab) {
        const parent = tab.parentElement
        if (parent.classList.contains('rounded-2xl')) return 'pills'
        if (parent.classList.contains('border-b')) return 'underline'
        return 'boxed'
    }

    updateCountBadge(badge, isSelected, variant) {
        badge.classList.remove(
            'bg-white/20', 'text-white',
            'bg-gray-100', 'dark:bg-slate-700', 'text-gray-600', 'dark:text-gray-400',
            'bg-primary-100', 'dark:bg-primary-900/30', 'text-primary-600', 'dark:text-primary-400',
            'text-gray-500', 'bg-gray-200', 'text-gray-300'
        )

        if (variant === 'pills') {
            if (isSelected) {
                badge.classList.add('bg-white/20', 'text-white')
            } else {
                badge.classList.add('bg-gray-100', 'dark:bg-slate-700', 'text-gray-600', 'dark:text-gray-400')
            }
        } else if (variant === 'underline') {
            if (isSelected) {
                badge.classList.add('bg-primary-100', 'dark:bg-primary-900/30', 'text-primary-600', 'dark:text-primary-400')
            } else {
                badge.classList.add('bg-gray-100', 'dark:bg-slate-700', 'text-gray-500')
            }
        } else {
            if (isSelected) {
                badge.classList.add('bg-gray-100', 'dark:bg-slate-600', 'text-gray-600', 'dark:text-gray-300')
            } else {
                badge.classList.add('bg-gray-200', 'dark:bg-slate-700', 'text-gray-500', 'dark:text-gray-400')
            }
        }
    }
}
