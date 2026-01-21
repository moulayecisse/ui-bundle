<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'slider',
    category: 'form',
    label: 'Slider',
    description: 'Range slider input with optional value display and ticks'
)]
class SliderStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name for submission.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'number', default: '0')]
    public string $value = 'Current slider value.';

    #[Prop(type: 'number', default: '0')]
    public string $min = 'Minimum value.';

    #[Prop(type: 'number', default: '100')]
    public string $max = 'Maximum value.';

    #[Prop(type: 'number', default: '1')]
    public string $step = 'Step increment between values.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the slider.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showValue = 'Show current value.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showMinMax = 'Show min and max labels.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Slider track and thumb size.';

    #[Prop(type: "'primary'|'secondary'|'success'|'warning'|'danger'|'info'", default: "'primary'")]
    public string $color = 'Slider color theme.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showTicks = 'Show tick marks below slider.';

    #[Prop(type: 'number', default: '5')]
    public string $tickCount = 'Number of tick marks when showTicks is true.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $valueFormat = 'Format string for value display (use %value% placeholder).';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Slider', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="basic" value="50" />
        </div>
        TWIG);
    }

    #[Story('With Value Display', order: 1)]
    public function withValue(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="display" value="75" showValue />
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-6">
            <div>
                <p class="text-sm text-gray-500 mb-2">Small</p>
                <twig:ui:slider name="size-sm" value="40" size="sm" showValue />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:slider name="size-md" value="50" size="md" showValue />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Large</p>
                <twig:ui:slider name="size-lg" value="60" size="lg" showValue />
            </div>
        </div>
        TWIG);
    }

    #[Story('Color Variants', order: 3)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:slider name="color-primary" value="50" color="primary" :showMinMax="false" />
            <twig:ui:slider name="color-success" value="50" color="success" :showMinMax="false" />
            <twig:ui:slider name="color-warning" value="50" color="warning" :showMinMax="false" />
            <twig:ui:slider name="color-danger" value="50" color="danger" :showMinMax="false" />
            <twig:ui:slider name="color-info" value="50" color="info" :showMinMax="false" />
        </div>
        TWIG);
    }

    #[Story('With Tick Marks', order: 4)]
    public function withTicks(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="ticks" value="40" showTicks :tickCount="5" :showMinMax="false" />
        </div>
        TWIG);
    }

    #[Story('Custom Value Format', order: 5)]
    public function valueFormat(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="format" value="75" showValue valueFormat="%value%%" />
        </div>
        TWIG);
    }

    #[Story('Custom Range (0-50)', order: 6)]
    public function customRange(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="range" value="25" min="0" max="50" showValue />
        </div>
        TWIG);
    }

    #[Story('With Steps (10)', order: 7)]
    public function withSteps(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="steps" value="50" step="10" showValue />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 8)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:slider name="disabled" value="30" disabled showValue />
        </div>
        TWIG);
    }
}
