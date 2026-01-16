<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'card',
    category: 'core',
    label: 'Card',
    description: 'Versatile card container with header, content, footer, and loading states'
)]
class CardStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $title = 'Card title text';

    #[Prop(type: 'string', default: "''")]
    public string $description = 'Card description below title';

    #[Prop(type: 'string', default: "''")]
    public string $icon = 'Icon name to display in header';

    #[Prop(type: 'boolean', default: 'false')]
    public string $divide = 'Show dividers between header, content, and footer';

    #[Prop(type: 'boolean', default: 'false')]
    public string $collapsible = 'Enable collapse/expand functionality';

    #[Prop(type: 'boolean', default: 'true')]
    public string $defaultExpanded = 'Initial expanded state (when collapsible)';

    #[Prop(type: 'string', default: "'div'")]
    public string $tag = 'HTML tag for the card container';

    #[Prop(type: 'boolean', default: 'true')]
    public string $border = 'Show border styling (auto: false when collapsible)';

    #[Prop(type: 'boolean', default: 'false')]
    public string $shadow = 'Show shadow (auto: true when collapsible)';

    #[Prop(type: 'string', default: "'visible'")]
    public string $overflow = 'Overflow behavior (auto: hidden when collapsible)';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loading = 'Show loading skeleton instead of content';

    #[Prop(type: 'number', default: '3')]
    public string $loadingLines = 'Number of skeleton lines when loading';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loadingAvatar = 'Show avatar in loading skeleton';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loadingActions = 'Show action buttons in loading skeleton';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $titleSlot = 'Custom title content (overrides title prop)';

    #[Slot]
    public string $descriptionSlot = 'Custom description content (overrides description prop)';

    #[Slot]
    public string $actions = 'Action buttons in the header area';

    #[Slot]
    public string $header = 'Custom header content';

    #[Slot]
    public string $content = 'Main card content';

    #[Slot]
    public string $footer = 'Footer content below main content';

    #[Story('Basic Card', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Basic Card" description="Using title and description props">
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This card uses the title and description props directly.
                </p>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Card with Footer', order: 1)]
    public function withFooter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Card with Footer">
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This card includes a footer section using a block.
                </p>
            </twig:block>
            <twig:block name="footer">
                <div class="flex gap-2">
                    <twig:ui:button variant="primary">Save</twig:ui:button>
                    <twig:ui:button variant="outline">Cancel</twig:ui:button>
                </div>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Card with Actions', order: 2)]
    public function withActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Card with Actions" description="Has action buttons in header">
            <twig:block name="actions">
                <twig:ui:button variant="ghost" icon="lucide:more-vertical" />
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    The actions block appears in the header area.
                </p>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Card with Dividers', order: 3)]
    public function withDividers(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Card with Dividers" divide>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    Using divide prop adds separators between sections.
                </p>
            </twig:block>
            <twig:block name="footer">
                <span class="text-sm text-gray-500">Footer with divider above</span>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Loading State', order: 4)]
    public function loading(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:card loading />
            <twig:ui:card loading :loadingAvatar="true" :loadingActions="true" />
        </div>
        TWIG);
    }

    #[Story('Loading with Custom Lines', order: 5)]
    public function loadingCustomLines(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-3 gap-4">
            <twig:ui:card loading :loadingLines="2" />
            <twig:ui:card loading :loadingLines="4" />
            <twig:ui:card loading :loadingLines="6" :loadingAvatar="true" />
        </div>
        TWIG);
    }

    #[Story('Shadow Variant', order: 6)]
    public function shadowVariant(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Shadow Card" :border="false" :shadow="true">
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    Card with shadow instead of border. Useful for elevated content.
                </p>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Collapsible Card', order: 7)]
    public function collapsible(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Collapsible Card" description="Click to expand/collapse" collapsible>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This content can be collapsed by clicking the toggle button in the header.
                </p>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Collapsible - Collapsed by Default', order: 8)]
    public function collapsibleCollapsed(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Collapsed by Default" collapsible :defaultExpanded="false">
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This card starts collapsed. Click to expand.
                </p>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }

    #[Story('Collapsible with Actions & Footer', order: 9)]
    public function collapsibleFull(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:card title="Full Featured Collapsible" description="With actions and footer" collapsible divide>
            <twig:block name="actions">
                <twig:ui:button variant="ghost" size="sm" icon="lucide:settings" />
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    Collapsible card with custom actions, content, and footer.
                </p>
            </twig:block>
            <twig:block name="footer">
                <div class="flex justify-end gap-2">
                    <twig:ui:button variant="outline" size="sm">Cancel</twig:ui:button>
                    <twig:ui:button variant="primary" size="sm">Save</twig:ui:button>
                </div>
            </twig:block>
        </twig:ui:card>
        TWIG);
    }
}
