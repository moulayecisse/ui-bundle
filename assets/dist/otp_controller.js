import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'hidden'];
    static values = {
        length: { type: Number, default: 6 }
    };

    connect() {
        this.updateHiddenValue();
    }

    handleInput(event) {
        const input = event.target;
        const index = parseInt(input.dataset.index, 10);
        const value = input.value.replace(/\D/g, '');

        if (value) {
            input.value = value.slice(-1);
            this.updateHiddenValue();

            // Move to next input
            if (index < this.lengthValue - 1) {
                this.inputTargets[index + 1]?.focus();
            }
        }
    }

    handleKeydown(event) {
        const input = event.target;
        const index = parseInt(input.dataset.index, 10);

        if (event.key === 'Backspace') {
            if (!input.value && index > 0) {
                this.inputTargets[index - 1]?.focus();
            }
            input.value = '';
            this.updateHiddenValue();
        } else if (event.key === 'ArrowLeft' && index > 0) {
            this.inputTargets[index - 1]?.focus();
        } else if (event.key === 'ArrowRight' && index < this.lengthValue - 1) {
            this.inputTargets[index + 1]?.focus();
        }
    }

    handlePaste(event) {
        event.preventDefault();
        const pastedData = event.clipboardData?.getData('text').replace(/\D/g, '').slice(0, this.lengthValue);

        if (pastedData) {
            pastedData.split('').forEach((char, i) => {
                if (this.inputTargets[i]) {
                    this.inputTargets[i].value = char;
                }
            });
            this.updateHiddenValue();

            // Focus last filled input or next empty
            const focusIndex = Math.min(pastedData.length, this.lengthValue - 1);
            this.inputTargets[focusIndex]?.focus();
        }
    }

    handleFocus(event) {
        event.target.select();
    }

    updateHiddenValue() {
        const value = this.inputTargets.map(input => input.value).join('');
        if (this.hasHiddenTarget) {
            this.hiddenTarget.value = value;
        }

        // Dispatch complete event when all digits are filled
        if (value.length === this.lengthValue) {
            this.dispatch('complete', { detail: { value } });
        }
    }
}
