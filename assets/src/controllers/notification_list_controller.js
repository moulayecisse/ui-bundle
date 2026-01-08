// assets/controllers/notification_list_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["notification"]
    static values = {
        autoDismiss: { type: Boolean, default: false },
        duration: { type: Number, default: 5000 }
    }

    connect() {
        if (this.autoDismissValue) {
            this.startAutoDismissTimers()
        }
    }

    startAutoDismissTimers() {
        this.notificationTargets.forEach(notification => {
            const id = notification.dataset.notificationId
            setTimeout(() => {
                this.dismissById(id)
            }, this.durationValue)
        })
    }

    dismiss(event) {
        const id = event.currentTarget.dataset.notificationId
        this.dismissById(id)
    }

    dismissById(id) {
        const notification = this.notificationTargets.find(n => n.dataset.notificationId === id)
        if (!notification) return

        // Animate out
        notification.classList.add('opacity-0', 'translate-x-4')

        setTimeout(() => {
            notification.remove()
            this.dispatch('dismiss', { detail: { id } })
        }, 300)
    }

    add(detail) {
        const { id, type, title, message, dismissible = true } = detail

        const notification = document.createElement('div')
        notification.dataset.cisseUiBundleNotificationListTarget = 'notification'
        notification.dataset.notificationId = id
        notification.className = 'transform transition-all duration-300 ease-out opacity-0 translate-x-4'

        // Get type config
        const typeConfig = {
            info: { icon: 'heroicons:information-circle-20-solid', bgClass: 'bg-blue-50 dark:bg-blue-900/20', iconClass: 'text-blue-500', titleClass: 'text-blue-800 dark:text-blue-200' },
            success: { icon: 'heroicons:check-circle-20-solid', bgClass: 'bg-green-50 dark:bg-green-900/20', iconClass: 'text-green-500', titleClass: 'text-green-800 dark:text-green-200' },
            warning: { icon: 'heroicons:exclamation-triangle-20-solid', bgClass: 'bg-yellow-50 dark:bg-yellow-900/20', iconClass: 'text-yellow-500', titleClass: 'text-yellow-800 dark:text-yellow-200' },
            error: { icon: 'heroicons:x-circle-20-solid', bgClass: 'bg-red-50 dark:bg-red-900/20', iconClass: 'text-red-500', titleClass: 'text-red-800 dark:text-red-200' }
        }
        const config = typeConfig[type] || typeConfig.info

        notification.innerHTML = `
            <div class="rounded-lg p-4 shadow-lg border border-gray-200 dark:border-gray-700 ${config.bgClass}">
                <div class="flex items-start gap-3">
                    <svg class="size-5 flex-shrink-0 ${config.iconClass}"></svg>
                    <div class="flex-1 min-w-0">
                        ${title ? `<p class="text-sm font-semibold ${config.titleClass}">${title}</p>` : ''}
                        ${message ? `<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">${message}</p>` : ''}
                    </div>
                    ${dismissible ? `
                        <button
                            type="button"
                            data-action="click->cisse--ui-bundle--notification-list#dismiss"
                            data-notification-id="${id}"
                            class="flex-shrink-0 rounded p-1 text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-800 transition-colors"
                            aria-label="Dismiss notification"
                        >
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    ` : ''}
                </div>
            </div>
        `

        this.element.appendChild(notification)

        // Animate in
        requestAnimationFrame(() => {
            notification.classList.remove('opacity-0', 'translate-x-4')
        })

        // Auto dismiss if enabled
        if (this.autoDismissValue) {
            setTimeout(() => {
                this.dismissById(id)
            }, this.durationValue)
        }
    }
}
