// assets/controllers/menu_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item", "submenu", "chevron"]
    static values = {
        sidebarToggle: { type: Boolean, default: false }
    }

    connect() {
        this.initializeMenuItems()
    }

    initializeMenuItems() {
        // Initialize each menu item's state
        this.itemTargets.forEach((item, index) => {
            const isActive = item.dataset.active === 'true'
            const submenu = item.querySelector('[data-menu-target="submenu"]')

            if (submenu) {
                // Set initial open state based on active status
                if (isActive) {
                    this.openSubmenu(item, false) // false = no animation on init
                } else {
                    this.closeSubmenu(item, false)
                }
            }
        })
    }

    toggle(event) {
        event.preventDefault()

        const menuItem = event.currentTarget.closest('[data-menu-target="item"]')
        if (!menuItem) return

        const submenu = menuItem.querySelector('[data-menu-target="submenu"]')
        if (!submenu) return

        const isCurrentlyOpen = submenu.dataset.open === 'true'

        if (isCurrentlyOpen) {
            this.closeSubmenu(menuItem)
        } else {
            this.openSubmenu(menuItem)
        }

        // Dispatch event
        this.dispatch('toggled', {
            detail: {
                item: menuItem,
                open: !isCurrentlyOpen
            }
        })
    }

    openSubmenu(menuItem, animate = true) {
        const submenu = menuItem.querySelector('[data-menu-target="submenu"]')
        const chevron = menuItem.querySelector('[data-menu-target="chevron"]')

        if (!submenu) return

        // Update state
        submenu.dataset.open = 'true'

        // Show submenu
        submenu.classList.remove('hidden')
        submenu.classList.add('block')

        // Rotate chevron
        if (chevron) {
            chevron.dataset.open = 'true'
            chevron.classList.add('rotate-180')
            chevron.classList.remove('rotate-0')
        }

        if (animate) {
            // Add entrance animation
            submenu.style.opacity = '0'
            submenu.style.transform = 'translateY(-5px)'
            submenu.style.transition = 'opacity 0.2s ease-out, transform 0.2s ease-out'

            // Force reflow
            submenu.offsetHeight

            submenu.style.opacity = '1'
            submenu.style.transform = 'translateY(0)'

            // Clean up after animation
            setTimeout(() => {
                submenu.style.opacity = ''
                submenu.style.transform = ''
                submenu.style.transition = ''
            }, 200)
        }
    }

    closeSubmenu(menuItem, animate = true) {
        const submenu = menuItem.querySelector('[data-menu-target="submenu"]')
        const chevron = menuItem.querySelector('[data-menu-target="chevron"]')

        if (!submenu) return

        // Update state
        submenu.dataset.open = 'false'

        // Rotate chevron back
        if (chevron) {
            chevron.dataset.open = 'false'
            chevron.classList.add('rotate-0')
            chevron.classList.remove('rotate-180')
        }

        if (animate) {
            // Add exit animation
            submenu.style.opacity = '1'
            submenu.style.transform = 'translateY(0)'
            submenu.style.transition = 'opacity 0.15s ease-in, transform 0.15s ease-in'

            // Force reflow
            submenu.offsetHeight

            submenu.style.opacity = '0'
            submenu.style.transform = 'translateY(-5px)'

            // Hide after animation
            setTimeout(() => {
                if (submenu.dataset.open === 'false') {
                    submenu.classList.remove('block')
                    submenu.classList.add('hidden')

                    // Reset styles
                    submenu.style.opacity = ''
                    submenu.style.transform = ''
                    submenu.style.transition = ''
                }
            }, 150)
        } else {
            // Just hide without animation
            submenu.classList.remove('block')
            submenu.classList.add('hidden')
        }
    }

    // Public API methods
    openAll() {
        this.itemTargets.forEach(item => {
            const submenu = item.querySelector('[data-menu-target="submenu"]')
            if (submenu) {
                this.openSubmenu(item)
            }
        })
    }

    closeAll() {
        this.itemTargets.forEach(item => {
            const submenu = item.querySelector('[data-menu-target="submenu"]')
            if (submenu) {
                this.closeSubmenu(item)
            }
        })
    }

    openItem(index) {
        const item = this.itemTargets[index]
        if (item) {
            this.openSubmenu(item)
        }
    }

    closeItem(index) {
        const item = this.itemTargets[index]
        if (item) {
            this.closeSubmenu(item)
        }
    }
}