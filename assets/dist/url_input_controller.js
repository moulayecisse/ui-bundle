import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'actions', 'openButton', 'invalidIcon'];
    static values = {
        showValidation: { type: Boolean, default: true }
    };

    connect() {
        this.isTouched = false;
        this.urlRegex = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/;
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
            this.hideAll();
            return;
        }

        const value = this.inputTarget.value;
        if (!value) {
            this.hideAll();
            return;
        }

        const isValid = this.urlRegex.test(value);

        if (isValid) {
            this.openButtonTarget.classList.remove('hidden');
            this.invalidIconTarget.classList.add('hidden');
            this.inputTarget.setAttribute('aria-invalid', 'false');
        } else {
            this.openButtonTarget.classList.add('hidden');
            this.invalidIconTarget.classList.remove('hidden');
            this.inputTarget.setAttribute('aria-invalid', 'true');
        }
    }

    hideAll() {
        this.openButtonTarget.classList.add('hidden');
        this.invalidIconTarget.classList.add('hidden');
    }

    openUrl() {
        const value = this.inputTarget.value;
        if (value && this.urlRegex.test(value)) {
            const url = value.startsWith('http') ? value : `https://${value}`;
            window.open(url, '_blank');
        }
    }
}
