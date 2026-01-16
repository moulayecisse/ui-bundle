<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'popover',
    category: 'core',
    label: 'Popover',
    description: 'Floating panel triggered by click or hover'
)]
class PopoverStory extends AbstractComponentStory
{
    #[Prop(type: "'bottom'|'top'|'left'|'right'", default: "'bottom'")]
    public string $position = 'Position of the popover relative to trigger';

    #[Prop(type: 'boolean', default: 'false')]
    public string $hover = 'Open on hover instead of click';

    #[Prop(type: "'auto'|'sm'|'md'|'lg'|'xl'|'full'", default: "'auto'")]
    public string $width = 'Width preset for the popover';

    #[Prop(type: 'number', default: '8')]
    public string $offset = 'Distance from trigger element in pixels';

    #[Prop(type: 'boolean', default: 'false')]
    public string $arrow = 'Show arrow pointing to trigger';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closeOnClickOutside = 'Close when clicking outside';

    #[Prop(type: "'default'|'dark'|'transparent'", default: "'default'")]
    public string $variant = 'Visual style variant';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $trigger = 'The element that triggers the popover (button, link, etc.)';

    #[Slot]
    public string $content = 'The popover content (default slot)';

    #[Story('Basic Popover', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center py-8">
            <twig:ui:popover>
                <twig:block name="trigger">
                    <twig:ui:button>Click me</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">This is a popover content.</p>
            </twig:ui:popover>
        </div>
        TWIG);
    }

    #[Story('Hover Popover', order: 1)]
    public function hoverPopover(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center py-8">
            <twig:ui:popover hover>
                <twig:block name="trigger">
                    <twig:ui:button variant="outline">Hover me</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">This appears on hover.</p>
            </twig:ui:popover>
        </div>
        TWIG);
    }

    #[Story('With Arrow', order: 2)]
    public function withArrow(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center py-8">
            <twig:ui:popover arrow>
                <twig:block name="trigger">
                    <twig:ui:button variant="outline">With Arrow</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">Notice the arrow pointing to the button.</p>
            </twig:ui:popover>
        </div>
        TWIG);
    }

    #[Story('Variant Styles', order: 3)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center gap-4 py-8">
            <twig:ui:popover variant="default">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline">Default</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">Default light variant.</p>
            </twig:ui:popover>
            <twig:ui:popover variant="dark">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline">Dark</twig:ui:button>
                </twig:block>
                <p class="text-sm">Dark variant popover.</p>
            </twig:ui:popover>
        </div>
        TWIG);
    }

    #[Story('Positions', order: 4)]
    public function positions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap justify-center gap-4 py-12">
            <twig:ui:popover position="top">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Top</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">Popover on top</p>
            </twig:ui:popover>
            <twig:ui:popover position="bottom">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Bottom</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">Popover on bottom</p>
            </twig:ui:popover>
            <twig:ui:popover position="left">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Left</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">Popover on left</p>
            </twig:ui:popover>
            <twig:ui:popover position="right">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Right</twig:ui:button>
                </twig:block>
                <p class="text-sm text-gray-700 dark:text-gray-300">Popover on right</p>
            </twig:ui:popover>
        </div>
        TWIG);
    }
}
