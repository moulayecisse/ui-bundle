import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['toggle', 'chevron', 'content', 'footer'];
    static values = {
        collapsed: { type: Boolean, default: false }
    };

    connect() {
        this.updateUI();
    }

    toggle(event) {
        if (event) {
            event.preventDefault();
        }
        this.collapsedValue = !this.collapsedValue;
        this.updateUI();
        this.dispatch('toggle', { detail: { collapsed: this.collapsedValue } });
    }

    updateUI() {
        if (this.hasChevronTarget) {
            if (this.collapsedValue) {
                this.chevronTarget.classList.add('-rotate-90');
            } else {
                this.chevronTarget.classList.remove('-rotate-90');
            }
        }

        if (this.hasContentTarget) {
            if (this.collapsedValue) {
                this.contentTarget.classList.add('hidden');
            } else {
                this.contentTarget.classList.remove('hidden');
            }
        }

        if (this.hasFooterTarget) {
            if (this.collapsedValue) {
                this.footerTarget.classList.add('hidden');
            } else {
                this.footerTarget.classList.remove('hidden');
            }
        }
    }
}
