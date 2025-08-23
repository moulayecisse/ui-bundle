// assets/controllers/slideover_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["slideOver", "backdrop", "panel", "closeButton"]
    static values = {
        open: { type: Boolean, default: false },
        closeOnBackdrop: { type: Boolean, default: true },
        closeOnEscape: { type: Boolean, default: true },
        position: { type: String, default: "right" },
        size: { type: String, default: "default" }
    }

    connect() {
        this.isOpen = this.openValue

        // Set up slide-over initially hidden
        if (this.hasSlideOverTarget) {
            this.slideOverTarget.style.display = 'none'
        }

        // Bind methods for event listeners
        this.handleEscapeKey = this.handleEscapeKey.bind(this)
        this.handleBackdropClick = this.handleBackdropClick.bind(this)

        // Set initial state
        if (this.isOpen) {
            this.open()
        }
    }

    disconnect() {
        this.removeEventListeners()
        // Restore body scroll if slide-over was open
        if (this.isOpen) {
            document.body.style.overflow = ''
        }
    }

    toggle() {
        if (this.isOpen) {
            this.close()
        } else {
            this.open()
        }
    }

    open() {
        if (this.isOpen) return

        this.isOpen = true

        // Store previously focused element
        this.previouslyFocusedElement = document.activeElement

        // Show slide-over
        this.slideOverTarget.style.display = 'block'

        // Add entrance animations
        this.animateIn()

        // Add event listeners
        this.addEventListeners()

        // Prevent body scroll
        document.body.style.overflow = 'hidden'

        // Focus management
        this.focusSlideOver()

        // Update ARIA
        this.slideOverTarget.setAttribute('aria-hidden', 'false')

        // Dispatch event
        this.dispatch('opened')
    }

    close() {
        if (!this.isOpen) return

        this.isOpen = false

        // Add exit animations
        this.animateOut()

        // Hide slide-over after animation
        setTimeout(() => {
            if (!this.isOpen) { // Double-check slide-over wasn't reopened
                this.slideOverTarget.style.display = 'none'
                this.resetStyles()
            }
        }, 500) // Match the animation duration

        // Remove event listeners
        this.removeEventListeners()

        // Restore body scroll
        document.body.style.overflow = ''

        // Restore focus
        if (this.previouslyFocusedElement) {
            this.previouslyFocusedElement.focus()
            this.previouslyFocusedElement = null
        }

        // Update ARIA
        this.slideOverTarget.setAttribute('aria-hidden', 'true')

        // Dispatch event
        this.dispatch('closed')
    }

    animateIn() {
        // Animate backdrop
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.opacity = '0'
            this.backdropTarget.style.transition = 'opacity 0.5s ease-in-out'

            // Force reflow
            this.backdropTarget.offsetHeight

            this.backdropTarget.style.opacity = '1'
        }

        // Animate panel
        if (this.hasPanelTarget) {
            const slideDirection = this.getSlideDirection()

            this.panelTarget.style.transform = slideDirection.start
            this.panelTarget.style.transition = 'transform 0.5s ease-in-out'

            // Force reflow
            this.panelTarget.offsetHeight

            this.panelTarget.style.transform = slideDirection.end
        }
    }

    animateOut() {
        // Animate backdrop
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.transition = 'opacity 0.5s ease-in-out'
            this.backdropTarget.style.opacity = '0'
        }

        // Animate panel
        if (this.hasPanelTarget) {
            const slideDirection = this.getSlideDirection()

            this.panelTarget.style.transition = 'transform 0.5s ease-in-out'
            this.panelTarget.style.transform = slideDirection.start
        }
    }

    getSlideDirection() {
        const position = this.positionValue

        const directions = {
            'right': {
                start: 'translateX(100%)',
                end: 'translateX(0%)'
            },
            'left': {
                start: 'translateX(-100%)',
                end: 'translateX(0%)'
            },
            'top': {
                start: 'translateY(-100%)',
                end: 'translateY(0%)'
            },
            'bottom': {
                start: 'translateY(100%)',
                end: 'translateY(0%)'
            }
        }

        return directions[position] || directions.right
    }

    resetStyles() {
        // Reset all animation styles
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.opacity = ''
            this.backdropTarget.style.transition = ''
        }

        if (this.hasPanelTarget) {
            this.panelTarget.style.transform = ''
            this.panelTarget.style.transition = ''
        }
    }

    addEventListeners() {
        if (this.closeOnEscapeValue) {
            document.addEventListener('keydown', this.handleEscapeKey)
        }

        if (this.closeOnBackdropValue && this.hasBackdropTarget) {
            this.backdropTarget.addEventListener('click', this.handleBackdropClick)
        }
    }

    removeEventListeners() {
        document.removeEventListener('keydown', this.handleEscapeKey)

        if (this.hasBackdropTarget) {
            this.backdropTarget.removeEventListener('click', this.handleBackdropClick)
        }
    }

    handleEscapeKey(event) {
        if (event.key === 'Escape') {
            this.close()
        }
    }

    handleBackdropClick(event) {
        // Only close if clicking directly on backdrop
        if (event.target === this.backdropTarget) {
            this.close()
        }
    }

    focusSlideOver() {
        // Focus the close button or first focusable element
        const focusableElements = this.panelTarget.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        )

        if (this.hasCloseButtonTarget) {
            this.closeButtonTarget.focus()
        } else if (focusableElements.length > 0) {
            focusableElements[0].focus()
        }
    }
}