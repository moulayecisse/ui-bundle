<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'range-slider',
    category: 'form',
    label: 'Range Slider',
    description: 'Dual-handle slider for selecting a value range'
)]
class RangeSliderStory extends AbstractComponentStory
{
    #[Prop(type: 'number', default: '0')]
    public string $min = 'Minimum range value';

    #[Prop(type: 'number', default: '100')]
    public string $max = 'Maximum range value';

    #[Prop(type: 'number', default: '1')]
    public string $step = 'Step increment between values';

    #[Prop(type: 'number', default: '25')]
    public string $minValue = 'Initial lower bound value';

    #[Prop(type: 'number', default: '75')]
    public string $maxValue = 'Initial upper bound value';

    #[Prop(type: 'string', default: "'range_min'")]
    public string $minName = 'Form field name for min value';

    #[Prop(type: 'string', default: "'range_max'")]
    public string $maxName = 'Form field name for max value';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the slider';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showLabels = 'Show current value labels';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showMinMax = 'Show min/max range labels';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Slider track and handle size';

    #[Prop(type: "'primary' | 'secondary' | 'success' | 'warning' | 'danger'", default: "'primary'")]
    public string $color = 'Slider color theme';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Range Slider', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:range-slider
                minName="price_min"
                maxName="price_max"
                minValue="25"
                maxValue="75"
            />
        </div>
        TWIG);
    }

    #[Story('Custom Range (0-1000)', order: 1)]
    public function customRange(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:range-slider
                minName="min_price"
                maxName="max_price"
                min="0"
                max="1000"
                minValue="200"
                maxValue="800"
            />
        </div>
        TWIG);
    }

    #[Story('With Steps (10)', order: 2)]
    public function withSteps(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:range-slider
                minName="step_min"
                maxName="step_max"
                min="0"
                max="100"
                step="10"
                minValue="20"
                maxValue="80"
            />
        </div>
        TWIG);
    }

    #[Story('Without Labels', order: 3)]
    public function withoutLabels(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:range-slider
                minName="no_labels_min"
                maxName="no_labels_max"
                minValue="30"
                maxValue="70"
                :showLabels="false"
            />
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-8">
            <div>
                <p class="text-sm text-gray-500 mb-2">Small</p>
                <twig:ui:range-slider minName="size_sm_min" maxName="size_sm_max" size="sm" minValue="20" maxValue="80" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:range-slider minName="size_md_min" maxName="size_md_max" size="md" minValue="25" maxValue="75" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Large</p>
                <twig:ui:range-slider minName="size_lg_min" maxName="size_lg_max" size="lg" minValue="30" maxValue="70" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Color Variants', order: 5)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-6">
            <twig:ui:range-slider minName="color_primary_min" maxName="color_primary_max" color="primary" minValue="20" maxValue="80" :showMinMax="false" />
            <twig:ui:range-slider minName="color_success_min" maxName="color_success_max" color="success" minValue="25" maxValue="75" :showMinMax="false" />
            <twig:ui:range-slider minName="color_warning_min" maxName="color_warning_max" color="warning" minValue="30" maxValue="70" :showMinMax="false" />
            <twig:ui:range-slider minName="color_danger_min" maxName="color_danger_max" color="danger" minValue="35" maxValue="65" :showMinMax="false" />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:range-slider
                minName="disabled_min"
                maxName="disabled_max"
                minValue="40"
                maxValue="60"
                disabled
            />
        </div>
        TWIG);
    }
}
