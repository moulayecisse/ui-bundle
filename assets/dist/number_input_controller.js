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
        return this.minValue === '' ? null : parseFloat(this.minValue);
    }

    get max() {
        return this.maxValue === '' ? null : parseFloat(this.maxValue);
    }

    get currentValue() {
        const value = this.inputTarget.value;
        return value === '' ? null : parseFloat(value);
    }

    set currentValue(value) {
        this.inputTarget.value = value === null ? '' : value;
        this.updateButtonStates();
        this.dispatch('change', { detail: { value } });
    }

    increment() {
        if (!this.canIncrement()) return;
        const current = this.currentValue ?? 0;
        const newValue = current + this.stepValue;
        this.currentValue = this.max !== null ? Math.min(newValue, this.max) : newValue;
    }

    decrement() {
        if (!this.canDecrement()) return;
        const current = this.currentValue ?? 0;
        const newValue = current - this.stepValue;
        this.currentValue = this.min !== null ? Math.max(newValue, this.min) : newValue;
    }

    handleInput() {
        const value = this.currentValue;
        if (value !== null && !isNaN(value)) {
            let clampedValue = value;
            if (this.min !== null) clampedValue = Math.max(clampedValue, this.min);
            if (this.max !== null) clampedValue = Math.min(clampedValue, this.max);
            if (clampedValue !== value) {
                this.currentValue = clampedValue;
            } else {
                this.updateButtonStates();
            }
        } else {
            this.updateButtonStates();
        }
    }

    canIncrement() {
        if (this.inputTarget.disabled) return false;
        if (this.currentValue === null) return true;
        if (this.max !== null) return this.currentValue < this.max;
        return true;
    }

    canDecrement() {
        if (this.inputTarget.disabled) return false;
        if (this.currentValue === null) return true;
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
