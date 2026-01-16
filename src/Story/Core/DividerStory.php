<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'divider',
    category: 'core',
    label: 'Divider',
    description: 'Horizontal or vertical line separator'
)]
class DividerStory extends AbstractComponentStory
{
    #[Prop(type: "'horizontal'|'vertical'", default: "'horizontal'")]
    public string $orientation = 'Divider direction';

    #[Prop(type: "'solid'|'dashed'|'dotted'", default: "'solid'")]
    public string $variant = 'Line style variant';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Line thickness';

    #[Prop(type: 'string|null', default: 'null')]
    public string $label = 'Optional text label centered on the divider';

    #[Prop(type: "'default'|'primary'|'muted'", default: "'default'")]
    public string $color = 'Color scheme';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Divider', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <p class="text-gray-600 dark:text-gray-400">Content above the divider</p>
            <twig:ui:divider />
            <p class="text-gray-600 dark:text-gray-400">Content below the divider</p>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 1)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:divider label="OR" />
            <twig:ui:divider label="Section Break" />
            <twig:ui:divider label="Continue reading" />
        </div>
        TWIG);
    }

    #[Story('Size Options', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <p class="text-xs text-gray-500 mb-2">Small (sm)</p>
                <twig:ui:divider size="sm" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Medium (md) - default</p>
                <twig:ui:divider size="md" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Large (lg)</p>
                <twig:ui:divider size="lg" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Variant Styles', order: 3)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <p class="text-xs text-gray-500 mb-2">Solid (default)</p>
                <twig:ui:divider variant="solid" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Dashed</p>
                <twig:ui:divider variant="dashed" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Dotted</p>
                <twig:ui:divider variant="dotted" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Color Options', order: 4)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <p class="text-xs text-gray-500 mb-2">Default</p>
                <twig:ui:divider color="default" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Primary</p>
                <twig:ui:divider color="primary" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Muted</p>
                <twig:ui:divider color="muted" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Vertical Orientation', order: 5)]
    public function vertical(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-4 h-20">
            <span class="text-gray-600 dark:text-gray-400">Left content</span>
            <twig:ui:divider orientation="vertical" />
            <span class="text-gray-600 dark:text-gray-400">Middle</span>
            <twig:ui:divider orientation="vertical" color="primary" />
            <span class="text-gray-600 dark:text-gray-400">Right content</span>
        </div>
        TWIG);
    }

    #[Story('Combined Options', order: 6)]
    public function combined(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <twig:ui:divider label="Primary Large" color="primary" size="lg" />
            <twig:ui:divider label="Dashed with Label" variant="dashed" />
            <div class="flex items-center h-16">
                <span class="text-gray-600 dark:text-gray-400">Item 1</span>
                <twig:ui:divider orientation="vertical" size="lg" color="primary" />
                <span class="text-gray-600 dark:text-gray-400">Item 2</span>
            </div>
        </div>
        TWIG);
    }
}
