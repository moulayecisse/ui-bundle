import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['trigger', 'menu'];

    connect() {
        this.closeOnClickOutside = this.closeOnClickOutside.bind(this);
        this.closeOnEscape = this.closeOnEscape.bind(this);
    }

    disconnect() {
        this.removeListeners();
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
        this.menuTarget.classList.remove('hidden');
        this.addListeners();
        this.dispatch('opened');
    }

    close() {
        this.menuTarget.classList.add('hidden');
        this.removeListeners();
        this.dispatch('closed');
    }

    isOpen() {
        return !this.menuTarget.classList.contains('hidden');
    }

    closeOnClickOutside(event) {
        if (!this.element.contains(event.target)) {
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
    }

    removeListeners() {
        document.removeEventListener('click', this.closeOnClickOutside);
        document.removeEventListener('keydown', this.closeOnEscape);
    }
}
