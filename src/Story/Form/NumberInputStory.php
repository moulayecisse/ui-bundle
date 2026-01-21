<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'number-input',
    category: 'form',
    label: 'Number Input',
    description: 'Numeric input with optional stepper buttons'
)]
class NumberInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $value = 'Input value.';

    #[Prop(type: 'string', default: "'0'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $min = 'Minimum value.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $max = 'Maximum value.';

    #[Prop(type: 'number', default: '1')]
    public string $step = 'Step increment value.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showStepper = 'Show increment/decrement buttons.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Number Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:number name="number" placeholder="Enter a number..." />
        </div>
        TWIG);
    }

    #[Story('With Stepper Buttons', order: 1)]
    public function withStepper(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Click the + and - buttons to increment/decrement the value.
            </p>
            <twig:ui:input:number name="number-stepper" :value="5" :showStepper="true" />
        </div>
        TWIG);
    }

    #[Story('Without Stepper', order: 2)]
    public function withoutStepper(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:number name="number-no-stepper" :showStepper="false" placeholder="Type a number..." />
        </div>
        TWIG);
    }

    #[Story('With Min/Max Constraints', order: 3)]
    public function withMinMax(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Value clamped between 0 and 10. Try to enter values outside this range.
            </p>
            <twig:ui:input:number name="number-minmax" :min="0" :max="10" :value="5" />
        </div>
        TWIG);
    }

    #[Story('Custom Step', order: 4)]
    public function customStep(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Step: 1 (default)</span>
                <twig:ui:input:number name="number-step1" :step="1" :value="0" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Step: 5</span>
                <twig:ui:input:number name="number-step5" :step="5" :value="0" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Step: 0.1</span>
                <twig:ui:input:number name="number-step01" :step="0.1" :value="0" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 5)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Small</span>
                <twig:ui:input:number name="number-sm" size="sm" :value="10" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:input:number name="number-md" size="md" :value="10" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:input:number name="number-lg" size="lg" :value="10" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:number name="number-disabled" :value="42" disabled />
        </div>
        TWIG);
    }
}
