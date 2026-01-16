<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'tooltip',
    category: 'core',
    label: 'Tooltip',
    description: 'Contextual information popup on hover or focus'
)]
class TooltipStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $tooltip = 'Tooltip text content';

    #[Prop(type: 'string', default: "''")]
    public string $contentProp = 'Trigger element content (alternative to slot)';

    #[Prop(type: "'top'|'bottom'|'left'|'right'", default: "'top'")]
    public string $position = 'Tooltip position relative to trigger';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showArrow = 'Show arrow pointing to trigger';

    #[Prop(type: 'boolean', default: 'false')]
    public string $unstyled = 'Remove default trigger styles';

    #[Prop(type: "'dark'|'light'|'primary'", default: "'dark'")]
    public string $variant = 'Tooltip color variant';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Tooltip text and padding size';

    #[Prop(type: 'number', default: '0')]
    public string $delay = 'Delay before showing tooltip (ms)';

    #[Prop(type: "'hover'|'click'|'focus'", default: "'hover'")]
    public string $trigger = 'Event that triggers tooltip';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Trigger element content';

    #[Slot]
    public string $tooltipSlot = 'Tooltip content (overrides tooltip prop)';

    #[Story('Basic Tooltip', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex gap-4">
            <twig:ui:tooltip tooltip="This is a tooltip" unstyled>
                <twig:ui:button variant="outline">Hover me</twig:ui:button>
            </twig:ui:tooltip>
        </div>
        TWIG);
    }

    #[Story('Positions', order: 1)]
    public function positions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-4 justify-center py-8">
            <twig:ui:tooltip tooltip="Top tooltip" position="top" unstyled>
                <twig:ui:button variant="outline">Top</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Bottom tooltip" position="bottom" unstyled>
                <twig:ui:button variant="outline">Bottom</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Left tooltip" position="left" unstyled>
                <twig:ui:button variant="outline">Left</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Right tooltip" position="right" unstyled>
                <twig:ui:button variant="outline">Right</twig:ui:button>
            </twig:ui:tooltip>
        </div>
        TWIG);
    }

    #[Story('Variants', order: 2)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-4 py-4">
            <twig:ui:tooltip tooltip="Dark variant (default)" variant="dark" unstyled>
                <twig:ui:button variant="outline">Dark</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Light variant" variant="light" unstyled>
                <twig:ui:button variant="outline">Light</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Primary variant" variant="primary" unstyled>
                <twig:ui:button variant="outline">Primary</twig:ui:button>
            </twig:ui:tooltip>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-4 py-4">
            <twig:ui:tooltip tooltip="Small tooltip" size="sm" unstyled>
                <twig:ui:button variant="outline" size="sm">Small</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Medium tooltip (default)" size="md" unstyled>
                <twig:ui:button variant="outline">Medium</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Large tooltip" size="lg" unstyled>
                <twig:ui:button variant="outline" size="lg">Large</twig:ui:button>
            </twig:ui:tooltip>
        </div>
        TWIG);
    }

    #[Story('Without Arrow', order: 4)]
    public function withoutArrow(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex gap-4 py-4">
            <twig:ui:tooltip tooltip="Tooltip without arrow" :showArrow="false" unstyled>
                <twig:ui:button variant="outline">No Arrow</twig:ui:button>
            </twig:ui:tooltip>
        </div>
        TWIG);
    }

    #[Story('Trigger Types', order: 5)]
    public function triggerTypes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-4 py-4">
            <twig:ui:tooltip tooltip="Hover trigger (default)" trigger="hover" unstyled>
                <twig:ui:button variant="outline">Hover</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Click trigger" trigger="click" unstyled>
                <twig:ui:button variant="outline">Click</twig:ui:button>
            </twig:ui:tooltip>
            <twig:ui:tooltip tooltip="Focus trigger" trigger="focus" unstyled>
                <twig:ui:button variant="outline">Focus</twig:ui:button>
            </twig:ui:tooltip>
        </div>
        TWIG);
    }
}
