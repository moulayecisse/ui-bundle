import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['trigger', 'preview', 'valueDisplay', 'chevron', 'input', 'dropdown', 'nativeInput', 'textInput', 'overlay'];

    connect() {
        this.isOpen = false;
        this.lightColors = ['#ffffff', '#f9fafb', '#f3f4f6', '#e5e7eb', '#eab308', '#f59e0b'];
    }

    toggle() {
        if (this.triggerTarget.disabled) return;

        if (this.isOpen) {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        this.isOpen = true;
        this.dropdownTarget.classList.remove('hidden');
        this.overlayTarget.classList.remove('hidden');
        this.chevronTarget.classList.add('rotate-180');
    }

    close() {
        this.isOpen = false;
        this.dropdownTarget.classList.add('hidden');
        this.overlayTarget.classList.add('hidden');
        this.chevronTarget.classList.remove('rotate-180');
    }

    selectColor(event) {
        const color = event.currentTarget.dataset.color;
        this.updateColor(color);
        this.updateSwatchSelection(color);
    }

    handleNativeInput(event) {
        const color = event.target.value;
        this.updateColor(color);
        this.updateSwatchSelection(color);
    }

    handleTextInput(event) {
        const color = event.target.value;
        // Validate hex color
        if (/^#([0-9A-Fa-f]{3}){1,2}$/.test(color)) {
            this.updateColor(color);
            this.updateSwatchSelection(color);
        }
    }

    updateColor(color) {
        this.inputTarget.value = color;
        this.previewTarget.style.backgroundColor = color;
        this.valueDisplayTarget.textContent = color;

        if (this.hasNativeInputTarget) {
            this.nativeInputTarget.value = color;
        }
        if (this.hasTextInputTarget) {
            this.textInputTarget.value = color;
        }

        this.dispatch('change', { detail: { color } });
    }

    updateSwatchSelection(selectedColor) {
        // Remove selection from all swatches
        const swatches = this.dropdownTarget.querySelectorAll('[data-color]');
        swatches.forEach(swatch => {
            const color = swatch.dataset.color;
            const isSelected = color === selectedColor;

            // Update border classes
            if (isSelected) {
                swatch.classList.add('border-primary-500', 'ring-2', 'ring-primary-500', 'ring-offset-1');
                swatch.classList.remove('border-transparent');

                // Add check icon if not present
                if (!swatch.querySelector('svg')) {
                    const iconColor = this.lightColors.includes(color) ? 'text-gray-800' : 'text-white';
                    swatch.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mx-auto ${iconColor}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    `;
                }
            } else {
                swatch.classList.remove('border-primary-500', 'ring-2', 'ring-primary-500', 'ring-offset-1');
                swatch.classList.add('border-transparent');

                // Remove check icon
                const icon = swatch.querySelector('svg');
                if (icon) {
                    icon.remove();
                }
            }
        });
    }
}
