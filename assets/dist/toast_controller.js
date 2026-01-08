import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        duration: { type: Number, default: 5000 }
    };

    connect() {
        if (this.durationValue > 0) {
            this.timeout = setTimeout(() => {
                this.close();
            }, this.durationValue);
        }
    }

    disconnect() {
        if (this.timeout) {
            clearTimeout(this.timeout);
        }
    }

    close() {
        // Add exit animation
        this.element.classList.add('opacity-0', 'translate-x-4', 'transition', 'duration-200', 'ease-in');

        setTimeout(() => {
            this.element.remove();
            this.dispatch('closed');
        }, 200);
    }
}
