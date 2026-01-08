import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'decrement', 'increment'];
    static values = {
        min: { type: String, default: '' },
        max: { type: String, default: '' },
        step: { type: Number, default: 1 }
    };

    connect() {
        this.updateButtonStates();
    }

    get min() {
        return this.minValue === '' ? null : parseInt(this.minValue, 10);
    }

    get max() {
        return this.maxValue === '' ? null : parseInt(this.maxValue, 10);
    }

    get currentValue() {
        return parseInt(this.inputTarget.value, 10) || 0;
    }

    set currentValue(value) {
        this.inputTarget.value = value;
        this.updateButtonStates();
        this.dispatch('change', { detail: { value } });
    }

    increment() {
        if (!this.canIncrement()) return;
        const newValue = this.currentValue + this.stepValue;
        this.currentValue = this.max !== null ? Math.min(newValue, this.max) : newValue;
    }

    decrement() {
        if (!this.canDecrement()) return;
        const newValue = this.currentValue - this.stepValue;
        this.currentValue = this.min !== null ? Math.max(newValue, this.min) : newValue;
    }

    handleInput() {
        const value = parseInt(this.inputTarget.value, 10);
        if (!isNaN(value)) {
            let clampedValue = value;
            if (this.min !== null) clampedValue = Math.max(clampedValue, this.min);
            if (this.max !== null) clampedValue = Math.min(clampedValue, this.max);
            if (clampedValue !== value) {
                this.currentValue = clampedValue;
            } else {
                this.updateButtonStates();
            }
        }
    }

    canIncrement() {
        if (this.inputTarget.disabled) return false;
        if (this.max !== null) return this.currentValue < this.max;
        return true;
    }

    canDecrement() {
        if (this.inputTarget.disabled) return false;
        if (this.min !== null) return this.currentValue > this.min;
        return true;
    }

    updateButtonStates() {
        if (this.hasDecrementTarget) {
            this.decrementTarget.disabled = !this.canDecrement();
        }
        if (this.hasIncrementTarget) {
            this.incrementTarget.disabled = !this.canIncrement();
        }
    }
}
