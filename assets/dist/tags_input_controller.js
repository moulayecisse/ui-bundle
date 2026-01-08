import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['tagsContainer', 'input', 'hiddenInputs', 'template'];
    static values = {
        max: { type: Number, default: 0 },
        allowDuplicates: { type: Boolean, default: false }
    };

    connect() {
        this.tags = this.getCurrentTags();
        this.name = this.element.querySelector('input[type="hidden"]')?.name?.replace('[]', '') || null;
    }

    getCurrentTags() {
        const tagElements = this.tagsContainerTarget.querySelectorAll('[data-tag-value]');
        return Array.from(tagElements).map(el => el.dataset.tagValue);
    }

    get canAddMore() {
        if (this.maxValue) {
            return this.tags.length < this.maxValue;
        }
        return true;
    }

    focusInput() {
        if (!this.inputTarget.disabled) {
            this.inputTarget.focus();
        }
    }

    handleKeydown(event) {
        if (event.key === 'Enter' || event.key === ',') {
            event.preventDefault();
            this.addTag(this.inputTarget.value);
        } else if (event.key === 'Backspace' && !this.inputTarget.value && this.tags.length > 0) {
            this.removeLastTag();
        }
    }

    handleBlur() {
        if (this.inputTarget.value) {
            this.addTag(this.inputTarget.value);
        }
    }

    addTag(value) {
        const trimmed = value.trim();
        if (!trimmed) return;
        if (!this.canAddMore) return;
        if (!this.allowDuplicatesValue && this.tags.includes(trimmed)) return;

        this.tags.push(trimmed);
        this.renderTag(trimmed);
        this.addHiddenInput(trimmed);
        this.inputTarget.value = '';
        this.updatePlaceholder();

        this.dispatch('tag-added', { detail: { tag: trimmed, tags: this.tags } });
    }

    renderTag(value) {
        const template = this.templateTarget.content.cloneNode(true);
        const span = template.querySelector('span');
        span.dataset.tagValue = value;

        const textEl = span.querySelector('[data-tag-text]');
        if (textEl) {
            textEl.textContent = value;
        } else {
            span.insertBefore(document.createTextNode(value), span.firstChild);
        }

        this.tagsContainerTarget.appendChild(span);
    }

    addHiddenInput(value) {
        if (!this.name) return;
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `${this.name}[]`;
        input.value = value;
        this.hiddenInputsTarget.appendChild(input);
    }

    removeTag(event) {
        const tagEl = event.target.closest('[data-tag-value]');
        if (!tagEl) return;

        const value = tagEl.dataset.tagValue;
        this.tags = this.tags.filter(t => t !== value);
        tagEl.remove();

        // Remove hidden input
        const hiddenInput = this.hiddenInputsTarget.querySelector(`input[value="${value}"]`);
        if (hiddenInput) {
            hiddenInput.remove();
        }

        this.updatePlaceholder();
        this.dispatch('tag-removed', { detail: { tag: value, tags: this.tags } });
    }

    removeLastTag() {
        const tagElements = this.tagsContainerTarget.querySelectorAll('[data-tag-value]');
        if (tagElements.length > 0) {
            const lastTag = tagElements[tagElements.length - 1];
            const value = lastTag.dataset.tagValue;
            this.tags.pop();
            lastTag.remove();

            // Remove hidden input
            const hiddenInputs = this.hiddenInputsTarget.querySelectorAll(`input[value="${value}"]`);
            if (hiddenInputs.length > 0) {
                hiddenInputs[hiddenInputs.length - 1].remove();
            }

            this.updatePlaceholder();
            this.dispatch('tag-removed', { detail: { tag: value, tags: this.tags } });
        }
    }

    updatePlaceholder() {
        const placeholder = this.inputTarget.dataset.placeholder || 'Add tag...';
        this.inputTarget.placeholder = this.tags.length === 0 ? placeholder : '';
    }
}
