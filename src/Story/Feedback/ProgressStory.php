<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'progress',
    category: 'feedback',
    label: 'Progress',
    description: 'Progress bar for showing completion status'
)]
class ProgressStory extends AbstractComponentStory
{
    #[Prop(type: 'number', default: '0')]
    public string $value = 'Current progress value';

    #[Prop(type: 'number', default: '100')]
    public string $max = 'Maximum value for progress';

    #[Prop(type: "'solid' | 'gradient'", default: "'solid'")]
    public string $variant = 'Progress bar style variant';

    #[Prop(type: "'primary' | 'secondary' | 'success' | 'warning' | 'danger' | 'info' | 'neutral'", default: "'primary'")]
    public string $color = 'Progress bar color';

    #[Prop(type: "'xs' | 'sm' | 'md' | 'lg' | 'xl'", default: "'md'")]
    public string $size = 'Height of the progress bar';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showLabel = 'Show progress label';

    #[Prop(type: 'string | null', default: 'null')]
    public string $label = 'Custom label text';

    #[Prop(type: "'top' | 'bottom' | 'inside'", default: "'top'")]
    public string $labelPosition = 'Label position';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showValue = 'Show percentage value when showLabel is true';

    #[Prop(type: "'percent' | 'fraction' | 'value'", default: "'percent'")]
    public string $valueFormat = 'Value display format';

    #[Prop(type: 'boolean', default: 'false')]
    public string $striped = 'Add striped pattern';

    #[Prop(type: 'boolean', default: 'false')]
    public string $animated = 'Animate the stripes';

    #[Prop(type: 'boolean', default: 'false')]
    public string $indeterminate = 'Show indeterminate loading state';

    #[Prop(type: 'boolean', default: 'true')]
    public string $rounded = 'Rounded corners';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Progress', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:progress :value="25" />
            <twig:ui:progress :value="50" />
            <twig:ui:progress :value="75" />
        </div>
        TWIG);
    }

    #[Story('With Label', order: 1)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:progress :value="60" showLabel />
            <twig:ui:progress :value="40" showLabel label="Uploading..." />
        </div>
        TWIG);
    }

    #[Story('Color Variants', order: 2)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-3">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Primary</span>
                <twig:ui:progress :value="60" color="primary" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Secondary</span>
                <twig:ui:progress :value="60" color="secondary" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Success</span>
                <twig:ui:progress :value="60" color="success" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Warning</span>
                <twig:ui:progress :value="60" color="warning" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Danger</span>
                <twig:ui:progress :value="60" color="danger" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Info</span>
                <twig:ui:progress :value="60" color="info" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Neutral</span>
                <twig:ui:progress :value="60" color="neutral" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Extra Small (xs)</span>
                <twig:ui:progress :value="60" size="xs" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Small (sm)</span>
                <twig:ui:progress :value="60" size="sm" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (md)</span>
                <twig:ui:progress :value="60" size="md" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large (lg)</span>
                <twig:ui:progress :value="60" size="lg" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Extra Large (xl)</span>
                <twig:ui:progress :value="60" size="xl" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Label Positions', order: 4)]
    public function labelPositions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-6">
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Top (default)</span>
                <twig:ui:progress :value="60" showLabel labelPosition="top" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Bottom</span>
                <twig:ui:progress :value="60" showLabel labelPosition="bottom" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Inside (large size)</span>
                <twig:ui:progress :value="60" size="lg" showLabel labelPosition="inside" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Value Formats', order: 5)]
    public function valueFormats(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Percent (default)</span>
                <twig:ui:progress :value="45" :max="100" showLabel valueFormat="percent" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Fraction</span>
                <twig:ui:progress :value="45" :max="100" showLabel valueFormat="fraction" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Value Only</span>
                <twig:ui:progress :value="45" :max="100" showLabel valueFormat="value" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Striped & Animated', order: 6)]
    public function striped(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Striped</span>
                <twig:ui:progress :value="60" striped />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Striped + Animated</span>
                <twig:ui:progress :value="60" striped animated />
            </div>
        </div>
        TWIG);
    }

    #[Story('Indeterminate', order: 7)]
    public function indeterminate(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:progress indeterminate />
            <twig:ui:progress indeterminate color="success" />
        </div>
        TWIG);
    }

    #[Story('Practical Examples', order: 8)]
    public function practical(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-6">
            <div>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block">File Upload</span>
                <twig:ui:progress :value="73" color="primary" showLabel label="Uploading file..." />
            </div>
            <div>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block">Storage Used</span>
                <twig:ui:progress :value="85" color="warning" showLabel label="Storage" />
            </div>
            <div>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block">Task Progress</span>
                <twig:ui:progress :value="100" color="success" showLabel label="Complete!" />
            </div>
        </div>
        TWIG);
    }
}
