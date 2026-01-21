<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'quantity-input',
    category: 'form',
    label: 'Quantity Input',
    description: 'Compact quantity selector with increment/decrement buttons'
)]
class QuantityInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'number', default: '1')]
    public string $value = 'Current quantity value.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'number', default: '1')]
    public string $min = 'Minimum value.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $max = 'Maximum value.';

    #[Prop(type: 'number', default: '1')]
    public string $step = 'Step increment value.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Quantity Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div>
            <twig:ui:input:quantity name="quantity" />
        </div>
        TWIG);
    }

    #[Story('With Initial Value', order: 1)]
    public function withValue(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Click the + and - buttons to change the value, or type directly in the input.
            </p>
            <twig:ui:input:quantity name="quantity-value" :value="5" />
        </div>
        TWIG);
    }

    #[Story('With Min/Max Constraints', order: 2)]
    public function withMinMax(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Value clamped between 1 and 10. The buttons will disable when limits are reached.
            </p>
            <twig:ui:input:quantity name="quantity-minmax" :min="1" :max="10" :value="5" />
        </div>
        TWIG);
    }

    #[Story('Custom Step', order: 3)]
    public function customStep(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Step: 1 (default)</span>
                <twig:ui:input:quantity name="quantity-step1" :step="1" :value="5" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Step: 5</span>
                <twig:ui:input:quantity name="quantity-step5" :step="5" :value="10" :min="0" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Step: 10</span>
                <twig:ui:input:quantity name="quantity-step10" :step="10" :value="50" :min="0" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Small</span>
                <twig:ui:input:quantity name="quantity-sm" size="sm" :value="3" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Medium (default)</span>
                <twig:ui:input:quantity name="quantity-md" size="md" :value="3" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Large</span>
                <twig:ui:input:quantity name="quantity-lg" size="lg" :value="3" />
            </div>
        </div>
        TWIG);
    }

    #[Story('E-commerce Example', order: 5)]
    public function ecommerce(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-center gap-4">
                <div class="size-16 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-900 dark:text-white">Product Name</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">$29.99</p>
                </div>
                <twig:ui:input:quantity name="cart-qty" size="sm" :min="1" :max="99" :value="1" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div>
            <twig:ui:input:quantity name="quantity-disabled" :value="3" disabled />
        </div>
        TWIG);
    }
}
