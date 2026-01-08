import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'status'];
    static values = {
        showValidation: { type: Boolean, default: true }
    };

    connect() {
        this.isTouched = false;
        this.emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    }

    handleBlur() {
        this.isTouched = true;
        this.updateValidation();
    }

    handleInput() {
        if (this.isTouched) {
            this.updateValidation();
        }
    }

    updateValidation() {
        if (!this.showValidationValue || !this.isTouched) {
            this.statusTarget.classList.add('hidden');
            return;
        }

        const value = this.inputTarget.value;
        if (!value) {
            this.statusTarget.classList.add('hidden');
            return;
        }

        this.statusTarget.classList.remove('hidden');
        const isValid = this.emailRegex.test(value);

        const validIcon = this.statusTarget.querySelector('[data-icon="valid"]');
        const invalidIcon = this.statusTarget.querySelector('[data-icon="invalid"]');

        if (isValid) {
            validIcon.classList.remove('hidden');
            invalidIcon.classList.add('hidden');
            this.inputTarget.setAttribute('aria-invalid', 'false');
        } else {
            validIcon.classList.add('hidden');
            invalidIcon.classList.remove('hidden');
            this.inputTarget.setAttribute('aria-invalid', 'true');
        }
    }
}
