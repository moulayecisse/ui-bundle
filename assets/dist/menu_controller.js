// assets/controllers/menu_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["item", "submenu", "chevron", "flyout"]
    static values = {}

    connect() {
        this.initializeMenuItems()
        this.setupFlyoutContainer()
    }

    disconnect() {
        // Clean up flyout container
        if (this.flyoutContainer) {
            this.flyoutContainer.remove()
        }
    }

    setupFlyoutContainer() {
        // Create a container at body level for flyouts
        this.flyoutContainer = document.getElementById('ui-menu-flyout-container')
        if (!this.flyoutContainer) {
            this.flyoutContainer = document.createElement('div')
            this.flyoutContainer.id = 'ui-menu-flyout-container'
            this.flyoutContainer.className = 'fixed inset-0 pointer-events-none z-[9999]'
            document.body.appendChild(this.flyoutContainer)
        }
    }

    initializeMenuItems() {
        // Initialize each menu item's state
        this.itemTargets.forEach((item, index) => {
            const isActive = item.dataset.active === 'true'
            const submenu = item.querySelector('[data-cisse--ui-bundle--menu-target="submenu"]')

            if (submenu) {
                // Check if any child in the submenu is active
                const hasActiveChild = submenu.querySelector('[data-active="true"]') !== null

                // Set initial open state based on active status or if has active children
                if (isActive || hasActiveChild) {
                    this.openSubmenu(item, false) // false = no animation on init
                } else {
                    this.closeSubmenu(item, false)
                }
            }
        })
    }

    toggle(event) {
        event.preventDefault()

        const menuItem = event.currentTarget.closest('[data-cisse--ui-bundle--menu-target="item"]')
        if (!menuItem) return

        const submenu = menuItem.querySelector('[data-cisse--ui-bundle--menu-target="submenu"]')
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
        const submenu = menuItem.querySelector('[data-cisse--ui-bundle--menu-target="submenu"]')
        const chevron = menuItem.querySelector('[data-cisse--ui-bundle--menu-target="chevron"]')

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
        const submenu = menuItem.querySelector('[data-cisse--ui-bundle--menu-target="submenu"]')
        const chevron = menuItem.querySelector('[data-cisse--ui-bundle--menu-target="chevron"]')

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

    // Flyout methods for collapsed sidebar
    showFlyout(event) {
        const menuItem = event.currentTarget.closest('[data-cisse--ui-bundle--menu-target="item"]')
        if (!menuItem) return

        const flyoutTemplate = menuItem.querySelector('[data-cisse--ui-bundle--menu-target="flyout"]')
        if (!flyoutTemplate) return

        // Check if sidebar is collapsed
        const sidebar = document.querySelector('[data-collapsed="true"]')
        if (!sidebar) return

        // Check if this is a submenu (has children) or simple tooltip
        const hasChildren = flyoutTemplate.querySelector('[data-flyout-children]') !== null

        // Clone the flyout content
        const flyout = flyoutTemplate.cloneNode(true)
        flyout.removeAttribute('data-cisse--ui-bundle--menu-target')
        flyout.id = 'ui-active-flyout'
        flyout.style.display = 'block'
        flyout.classList.remove('hidden')
        flyout.classList.add('pointer-events-auto')

        // Position the flyout
        const rect = menuItem.getBoundingClientRect()
        flyout.style.position = 'fixed'
        flyout.style.left = `${rect.right + 8}px`

        if (hasChildren) {
            // Submenu: align to top of menu item
            flyout.style.top = `${rect.top}px`
        } else {
            // Tooltip: center vertically with menu item
            flyout.style.top = `${rect.top + rect.height / 2}px`
            flyout.style.transform = 'translateY(-50%)'
        }

        // Add hover handlers to keep flyout open
        flyout.addEventListener('mouseenter', () => {
            this.cancelHideFlyout()
        })
        flyout.addEventListener('mouseleave', () => {
            this.scheduleHideFlyout()
        })

        // Clear any existing flyout
        this.hideFlyoutImmediate()

        // Add to container
        this.flyoutContainer.appendChild(flyout)

        // Store whether this is a tooltip for animation
        flyout.dataset.isTooltip = hasChildren ? 'false' : 'true'

        // Animate in
        flyout.style.opacity = '0'
        if (hasChildren) {
            flyout.style.transform = 'scale(0.95)'
        } else {
            flyout.style.transform = 'translateY(-50%) scale(0.95)'
        }
        flyout.offsetHeight // Force reflow
        flyout.style.transition = 'opacity 0.15s ease-out, transform 0.15s ease-out'
        flyout.style.opacity = '1'
        if (hasChildren) {
            flyout.style.transform = 'scale(1)'
        } else {
            flyout.style.transform = 'translateY(-50%) scale(1)'
        }
    }

    scheduleHideFlyout() {
        this.hideTimeout = setTimeout(() => {
            this.hideFlyout()
        }, 100)
    }

    cancelHideFlyout() {
        if (this.hideTimeout) {
            clearTimeout(this.hideTimeout)
            this.hideTimeout = null
        }
    }

    hideFlyout() {
        const flyout = document.getElementById('ui-active-flyout')
        if (!flyout) return

        const isTooltip = flyout.dataset.isTooltip === 'true'

        flyout.style.transition = 'opacity 0.1s ease-in, transform 0.1s ease-in'
        flyout.style.opacity = '0'
        if (isTooltip) {
            flyout.style.transform = 'translateY(-50%) scale(0.95)'
        } else {
            flyout.style.transform = 'scale(0.95)'
        }

        setTimeout(() => {
            flyout.remove()
        }, 100)
    }

    hideFlyoutImmediate() {
        const flyout = document.getElementById('ui-active-flyout')
        if (flyout) {
            flyout.remove()
        }
    }

    // Public API methods
    openAll() {
        this.itemTargets.forEach(item => {
            const submenu = item.querySelector('[data-cisse--ui-bundle--menu-target="submenu"]')
            if (submenu) {
                this.openSubmenu(item)
            }
        })
    }

    closeAll() {
        this.itemTargets.forEach(item => {
            const submenu = item.querySelector('[data-cisse--ui-bundle--menu-target="submenu"]')
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
