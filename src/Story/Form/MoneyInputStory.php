<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'money-input',
    category: 'form',
    label: 'Money Input',
    description: 'Currency-aware numeric input with formatting'
)]
class MoneyInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $value = 'Input value.';

    #[Prop(type: 'string', default: "'0.00'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: "'EUR'|'USD'|'GBP'|'XOF'|'MAD'|'CHF'|'CAD'", default: "'EUR'")]
    public string $currency = 'Currency code.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $min = 'Minimum value.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $max = 'Maximum value.';

    #[Prop(type: 'number', default: '2')]
    public string $decimals = 'Decimal places.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'FormView|null', default: 'null')]
    public string $form = 'Symfony form field for auto-configuration.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Money Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:money name="amount" placeholder="0.00" />
        </div>
        TWIG);
    }

    #[Story('Different Currencies', order: 1)]
    public function currencies(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">EUR (Euro) - suffix symbol</span>
                <twig:ui:input:money name="amount-eur" currency="EUR" :value="1234.56" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">USD (US Dollar) - prefix symbol</span>
                <twig:ui:input:money name="amount-usd" currency="USD" :value="1234.56" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">GBP (British Pound) - prefix symbol</span>
                <twig:ui:input:money name="amount-gbp" currency="GBP" :value="1234.56" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">XOF (CFA Franc) - suffix symbol</span>
                <twig:ui:input:money name="amount-xof" currency="XOF" :value="5000" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Min/Max Constraints', order: 2)]
    public function withMinMax(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Value clamped between 0 and 1000. Values are formatted on blur.
            </p>
            <twig:ui:input:money name="amount-minmax" :min="0" :max="1000" :value="500" />
        </div>
        TWIG);
    }

    #[Story('Custom Decimals', order: 3)]
    public function customDecimals(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">0 decimals</span>
                <twig:ui:input:money name="amount-dec0" :decimals="0" :value="1234" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">2 decimals (default)</span>
                <twig:ui:input:money name="amount-dec2" :decimals="2" :value="1234.56" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">4 decimals</span>
                <twig:ui:input:money name="amount-dec4" :decimals="4" :value="1234.5678" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 4)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:label for="amount-label">Price</twig:ui:label>
            <twig:ui:input:money name="amount-label" id="amount-label" currency="EUR" required />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 5)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:money name="amount-disabled" :value="99.99" disabled />
        </div>
        TWIG);
    }
}
