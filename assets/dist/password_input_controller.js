import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['input', 'toggle', 'strengthContainer', 'strengthBar', 'strengthLabel'];
    static values = {
        showStrength: { type: Boolean, default: false },
        minLength: { type: Number, default: 8 }
    };

    connect() {
        this.isVisible = false;
    }

    toggleVisibility() {
        this.isVisible = !this.isVisible;
        this.inputTarget.type = this.isVisible ? 'text' : 'password';

        const showIcon = this.toggleTarget.querySelector('[data-icon="show"]');
        const hideIcon = this.toggleTarget.querySelector('[data-icon="hide"]');

        if (this.isVisible) {
            showIcon.classList.add('hidden');
            hideIcon.classList.remove('hidden');
        } else {
            showIcon.classList.remove('hidden');
            hideIcon.classList.add('hidden');
        }
    }

    handleInput() {
        if (this.showStrengthValue && this.hasStrengthContainerTarget) {
            this.updateStrength();
        }
    }

    updateStrength() {
        const password = this.inputTarget.value;

        if (!password) {
            this.strengthContainerTarget.classList.add('hidden');
            return;
        }

        this.strengthContainerTarget.classList.remove('hidden');

        const strength = this.calculateStrength(password);
        const config = this.getStrengthConfig(strength);

        this.strengthBarTarget.className = `h-full rounded-full transition-all duration-300 ${config.color} ${config.width}`;
        this.strengthLabelTarget.textContent = config.label;
        this.strengthLabelTarget.className = `mt-1 text-xs font-medium ${config.textColor}`;
    }

    calculateStrength(password) {
        let score = 0;

        // Length check
        if (password.length >= this.minLengthValue) score++;
        if (password.length >= 12) score++;

        // Character variety checks
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        if (score <= 2) return 'weak';
        if (score <= 3) return 'fair';
        if (score <= 4) return 'good';
        return 'strong';
    }

    getStrengthConfig(strength) {
        const configs = {
            weak: { label: 'Weak', color: 'bg-red-500', width: 'w-1/4', textColor: 'text-red-500' },
            fair: { label: 'Fair', color: 'bg-orange-500', width: 'w-2/4', textColor: 'text-orange-500' },
            good: { label: 'Good', color: 'bg-yellow-500', width: 'w-3/4', textColor: 'text-yellow-600 dark:text-yellow-500' },
            strong: { label: 'Strong', color: 'bg-emerald-500', width: 'w-full', textColor: 'text-emerald-500' },
        };
        return configs[strength];
    }
}
