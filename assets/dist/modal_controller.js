// assets/controllers/modal_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["modal", "backdrop", "content", "closeButton"]
    static values = {
        open: { type: Boolean, default: false },
        closeOnBackdrop: { type: Boolean, default: true },
        closeOnEscape: { type: Boolean, default: true },
        size: { type: String, default: "default" }
    }

    connect() {
        this.isOpen = this.openValue

        // Set up modal initially hidden
        if (this.hasModalTarget) {
            this.modalTarget.style.display = 'none'
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
        // Restore body scroll if modal was open
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

        // Show modal
        this.modalTarget.style.display = 'flex'

        // Add entrance animation
        this.modalTarget.style.opacity = '0'
        this.modalTarget.offsetHeight // Force reflow

        this.modalTarget.style.transition = 'opacity 0.3s ease-out'
        this.modalTarget.style.opacity = '1'

        // Animate backdrop
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.opacity = '0'
            this.backdropTarget.offsetHeight // Force reflow
            this.backdropTarget.style.transition = 'opacity 0.3s ease-out'
            this.backdropTarget.style.opacity = '1'
        }

        // Animate content
        if (this.hasContentTarget) {
            this.contentTarget.style.transform = 'scale(0.95) translateY(-10px)'
            this.contentTarget.style.transition = 'transform 0.3s ease-out'
            this.contentTarget.offsetHeight // Force reflow
            this.contentTarget.style.transform = 'scale(1) translateY(0)'
        }

        // Add event listeners
        this.addEventListeners()

        // Prevent body scroll
        document.body.style.overflow = 'hidden'

        // Focus management
        this.focusModal()

        // Update ARIA
        this.modalTarget.setAttribute('aria-hidden', 'false')

        // Dispatch event
        this.dispatch('opened')
    }

    close() {
        if (!this.isOpen) return

        this.isOpen = false

        // Add exit animation
        this.modalTarget.style.transition = 'opacity 0.25s ease-in'
        this.modalTarget.style.opacity = '0'

        // Animate backdrop
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.transition = 'opacity 0.25s ease-in'
            this.backdropTarget.style.opacity = '0'
        }

        // Animate content
        if (this.hasContentTarget) {
            this.contentTarget.style.transition = 'transform 0.25s ease-in'
            this.contentTarget.style.transform = 'scale(0.95) translateY(-10px)'
        }

        // Hide modal after animation
        setTimeout(() => {
            if (!this.isOpen) { // Double-check modal wasn't reopened
                this.modalTarget.style.display = 'none'

                // Reset transforms and opacity
                this.modalTarget.style.opacity = ''
                this.modalTarget.style.transition = ''

                if (this.hasBackdropTarget) {
                    this.backdropTarget.style.opacity = ''
                    this.backdropTarget.style.transition = ''
                }

                if (this.hasContentTarget) {
                    this.contentTarget.style.transform = ''
                    this.contentTarget.style.transition = ''
                }
            }
        }, 250)

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
        this.modalTarget.setAttribute('aria-hidden', 'true')

        // Dispatch event
        this.dispatch('closed')
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
        // Only close if clicking directly on backdrop, not on content
        if (event.target === this.backdropTarget) {
            this.close()
        }
    }

    focusModal() {
        // Focus the modal content or first focusable element
        const focusableElements = this.contentTarget.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        )

        if (focusableElements.length > 0) {
            focusableElements[0].focus()
        } else if (this.hasCloseButtonTarget) {
            this.closeButtonTarget.focus()
        }
    }

    // Handle clicking outside content (when backdrop click is disabled)
    clickOutside(event) {
        if (!this.closeOnBackdropValue) return

        // This is called by Stimulus when clicking outside the content target
        this.close()
    }
}