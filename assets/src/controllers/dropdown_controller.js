import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['trigger', 'menu'];
    static values = {
        strategy: { type: String, default: 'absolute' },
        align: { type: String, default: 'right' },
    };

    connect() {
        this.closeOnClickOutside = this.closeOnClickOutside.bind(this);
        this.closeOnEscape = this.closeOnEscape.bind(this);
        this.updatePosition = this.updatePosition.bind(this);
        this.teleported = false;
        this.originalParent = null;
        // Cache menu element reference for when it's teleported
        this._menuElement = null;
    }

    disconnect() {
        this.removeListeners();
        // Restore menu to original position if teleported
        if (this.teleported && this.originalParent && this._menuElement) {
            this.originalParent.appendChild(this._menuElement);
            this._menuElement.style.cssText = '';
            this.teleported = false;
        }
    }

    /**
     * Get the menu element, handling teleported state
     */
    get menu() {
        if (this._menuElement) {
            return this._menuElement;
        }
        return this.hasMenuTarget ? this.menuTarget : null;
    }

    toggle(event) {
        event.stopPropagation();
        if (this.isOpen()) {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        if (this.strategyValue === 'fixed') {
            this.teleportMenu();
        }
        this.menu.classList.remove('hidden');
        if (this.hasTriggerTarget) {
            this.triggerTarget.setAttribute('aria-expanded', 'true');
        }
        this.addListeners();
        this.dispatch('opened');
    }

    close() {
        this.menu.classList.add('hidden');
        if (this.hasTriggerTarget) {
            this.triggerTarget.setAttribute('aria-expanded', 'false');
        }
        this.removeListeners();
        this.dispatch('closed');
    }

    isOpen() {
        return this.menu && !this.menu.classList.contains('hidden');
    }

    /**
     * Teleport menu to body and position it fixed relative to trigger
     */
    teleportMenu() {
        if (!this.teleported) {
            // Cache the menu element before teleporting
            this._menuElement = this.menuTarget;
            this.originalParent = this._menuElement.parentElement;
            document.body.appendChild(this._menuElement);
            this.teleported = true;
        }
        this.updatePosition();
    }

    /**
     * Update menu position based on trigger location
     */
    updatePosition() {
        if (!this.hasTriggerTarget || !this.menu) return;

        const menu = this.menu;
        const triggerRect = this.triggerTarget.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const viewportWidth = window.innerWidth;
        const gap = 8; // mt-2 equivalent

        // Temporarily show menu to get accurate dimensions
        const wasHidden = menu.classList.contains('hidden');
        if (wasHidden) {
            menu.style.visibility = 'hidden';
            menu.classList.remove('hidden');
        }

        const menuRect = menu.getBoundingClientRect();

        // Restore hidden state temporarily
        if (wasHidden) {
            menu.classList.add('hidden');
            menu.style.visibility = '';
        }

        let top = triggerRect.bottom + gap;
        let left;

        // Horizontal alignment - align right edge of menu with right edge of trigger
        if (this.alignValue === 'left') {
            left = triggerRect.left;
        } else if (this.alignValue === 'center') {
            left = triggerRect.left + (triggerRect.width / 2) - (menuRect.width / 2);
        } else {
            // right (default) - align right edges
            left = triggerRect.right - menuRect.width;
        }

        // Ensure menu doesn't overflow right edge
        if (left + menuRect.width > viewportWidth) {
            left = viewportWidth - menuRect.width - gap;
        }

        // Ensure menu doesn't overflow left edge
        if (left < gap) {
            left = gap;
        }

        // Check if menu would overflow bottom of viewport
        if (top + menuRect.height > viewportHeight) {
            // Position above trigger instead
            top = triggerRect.top - menuRect.height - gap;
        }

        // Ensure menu doesn't overflow top edge
        if (top < gap) {
            top = gap;
        }

        menu.style.position = 'fixed';
        menu.style.top = `${top}px`;
        menu.style.left = `${left}px`;
        menu.style.margin = '0';
    }

    closeOnClickOutside(event) {
        // Check if click is outside both the controller element and the teleported menu
        if (!this.element.contains(event.target) && !this.menu.contains(event.target)) {
            this.close();
        }
    }

    closeOnEscape(event) {
        if (event.key === 'Escape') {
            this.close();
        }
    }

    addListeners() {
        document.addEventListener('click', this.closeOnClickOutside);
        document.addEventListener('keydown', this.closeOnEscape);
        if (this.strategyValue === 'fixed') {
            window.addEventListener('scroll', this.updatePosition, true);
            window.addEventListener('resize', this.updatePosition);
        }
    }

    removeListeners() {
        document.removeEventListener('click', this.closeOnClickOutside);
        document.removeEventListener('keydown', this.closeOnEscape);
        if (this.strategyValue === 'fixed') {
            window.removeEventListener('scroll', this.updatePosition, true);
            window.removeEventListener('resize', this.updatePosition);
        }
    }
}
