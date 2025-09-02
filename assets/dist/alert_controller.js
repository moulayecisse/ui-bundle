// assets/controllers/alert_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    connect() {
        // Set up any initial state if needed
        this.element.setAttribute('role', 'alert')
        this.element.setAttribute('aria-live', 'polite')
    }

    dismiss(event) {
        event.preventDefault()
        
        // Dispatch dismiss event before removing
        this.dispatch('dismissed', {
            detail: {
                element: this.element,
                color: this.element.dataset.color,
                variant: this.element.dataset.variant
            }
        })

        // Add exit animation
        this.element.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out'
        this.element.style.opacity = '0'
        this.element.style.transform = 'translateY(-10px)'

        // Remove element after animation
        setTimeout(() => {
            if (this.element.parentNode) {
                this.element.remove()
            }
        }, 300)
    }

    // Public API method to dismiss programmatically
    hide() {
        this.dismiss({ preventDefault: () => {} })
    }

    // Public API method to show (if hidden)
    show() {
        this.element.style.opacity = '1'
        this.element.style.transform = 'translateY(0)'
        this.element.style.display = 'block'
        
        this.dispatch('shown', {
            detail: {
                element: this.element,
                color: this.element.dataset.color,
                variant: this.element.dataset.variant
            }
        })
    }
}