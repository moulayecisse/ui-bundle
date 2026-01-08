import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['trigger', 'popover'];
    static values = {
        hover: { type: Boolean, default: false },
        position: { type: String, default: 'bottom' }
    };

    connect() {
        this.isOpen = false;

        // Close on outside click
        this.handleOutsideClick = this.handleOutsideClick.bind(this);
        document.addEventListener('click', this.handleOutsideClick);

        // Close on escape
        this.handleEscape = this.handleEscape.bind(this);
        document.addEventListener('keydown', this.handleEscape);
    }

    disconnect() {
        document.removeEventListener('click', this.handleOutsideClick);
        document.removeEventListener('keydown', this.handleEscape);
    }

    toggle() {
        if (this.isOpen) {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        this.isOpen = true;
        this.popoverTarget.style.display = 'block';
        this.positionPopover();

        // Add animation classes
        this.popoverTarget.classList.add('transition', 'duration-150', 'ease-out');
    }

    close() {
        this.isOpen = false;
        this.popoverTarget.style.display = 'none';
    }

    positionPopover() {
        const trigger = this.triggerTarget;
        const popover = this.popoverTarget;
        const position = this.positionValue;

        // Reset positioning
        popover.style.top = '';
        popover.style.bottom = '';
        popover.style.left = '';
        popover.style.right = '';

        const gap = 8;

        switch (position) {
            case 'top':
                popover.style.bottom = '100%';
                popover.style.left = '50%';
                popover.style.transform = 'translateX(-50%)';
                popover.style.marginBottom = `${gap}px`;
                break;
            case 'bottom':
                popover.style.top = '100%';
                popover.style.left = '50%';
                popover.style.transform = 'translateX(-50%)';
                popover.style.marginTop = `${gap}px`;
                break;
            case 'left':
                popover.style.right = '100%';
                popover.style.top = '50%';
                popover.style.transform = 'translateY(-50%)';
                popover.style.marginRight = `${gap}px`;
                break;
            case 'right':
                popover.style.left = '100%';
                popover.style.top = '50%';
                popover.style.transform = 'translateY(-50%)';
                popover.style.marginLeft = `${gap}px`;
                break;
        }
    }

    handleOutsideClick(event) {
        if (!this.hoverValue && this.isOpen && !this.element.contains(event.target)) {
            this.close();
        }
    }

    handleEscape(event) {
        if (event.key === 'Escape' && this.isOpen) {
            this.close();
        }
    }
}
