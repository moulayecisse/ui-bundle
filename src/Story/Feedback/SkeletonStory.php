<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'skeleton',
    category: 'feedback',
    label: 'Skeleton',
    description: 'Loading placeholder for content'
)]
class SkeletonStory extends AbstractComponentStory
{
    #[Prop(type: "'text' | 'circular' | 'rectangular' | 'rounded' | 'avatar' | 'button' | 'input' | 'card'", default: "'text'")]
    public string $variant = 'Skeleton shape variant';

    #[Prop(type: 'string | null', default: 'null')]
    public string $width = 'Custom width (CSS value)';

    #[Prop(type: 'string | null', default: 'null')]
    public string $height = 'Custom height (CSS value)';

    #[Prop(type: 'number', default: '1')]
    public string $lines = 'Number of lines (text variant only)';

    #[Prop(type: 'boolean', default: 'true')]
    public string $animate = 'Enable pulse animation';

    #[Prop(type: "'slow' | 'normal' | 'fast'", default: "'normal'")]
    public string $speed = 'Animation speed';

    #[Prop(type: "'default' | 'primary' | 'light'", default: "'default'")]
    public string $color = 'Background color theme';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Text Skeleton', order: 0)]
    public function text(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-2">
            <twig:ui:skeleton width="100%" height="1rem" />
            <twig:ui:skeleton width="80%" height="1rem" />
            <twig:ui:skeleton width="60%" height="1rem" />
        </div>
        TWIG);
    }

    #[Story('Card Skeleton', order: 1)]
    public function card(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:skeleton variant="card" />
        </div>
        TWIG);
    }

    #[Story('Avatar with Text', order: 2)]
    public function avatarWithText(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-3">
            <twig:ui:skeleton variant="circle" width="3rem" height="3rem" />
            <div class="space-y-2 flex-1">
                <twig:ui:skeleton width="40%" height="1rem" />
                <twig:ui:skeleton width="60%" height="0.75rem" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Table Skeleton', order: 3)]
    public function table(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:skeleton variant="table" rows="3" />
        TWIG);
    }

    #[Story('Animation Speeds', order: 4)]
    public function speeds(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div>
                <p class="text-xs text-gray-500 mb-2">Slow</p>
                <twig:ui:skeleton width="100%" height="1rem" speed="slow" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Normal (default)</p>
                <twig:ui:skeleton width="100%" height="1rem" speed="normal" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Fast</p>
                <twig:ui:skeleton width="100%" height="1rem" speed="fast" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Color Variants', order: 5)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div>
                <p class="text-xs text-gray-500 mb-2">Default</p>
                <twig:ui:skeleton width="100%" height="1rem" color="default" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Primary</p>
                <twig:ui:skeleton width="100%" height="1rem" color="primary" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Light</p>
                <twig:ui:skeleton width="100%" height="1rem" color="light" />
            </div>
        </div>
        TWIG);
    }

    #[Story('More Variants', order: 6)]
    public function moreVariants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <twig:ui:skeleton variant="avatar" />
                <span class="text-xs text-gray-500">Avatar</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <twig:ui:skeleton variant="button" width="8rem" />
                </div>
                <span class="text-xs text-gray-500">Button</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <twig:ui:skeleton variant="input" />
                </div>
                <span class="text-xs text-gray-500">Input</span>
            </div>
        </div>
        TWIG);
    }

    #[Story('Line Chart Skeleton', order: 7)]
    public function lineChart(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:skeleton:chart variant="line" height="16rem" />
        TWIG);
    }

    #[Story('Bar Chart Skeleton', order: 8)]
    public function barChart(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:skeleton:chart variant="bar" height="16rem" bars="8" />
        TWIG);
    }
}
