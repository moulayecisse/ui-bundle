<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'command-palette/item',
    category: 'core',
    label: 'Command Palette Item',
    description: 'A single command item within a command palette'
)]
class CommandPaletteItemStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $icon = 'Icon name (e.g., lucide:search).';

    #[Prop(type: 'string', default: "''")]
    public string $label = 'Primary text label.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $description = 'Secondary description text.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $shortcut = 'Keyboard shortcut (e.g., "⌘ + K").';

    #[Prop(type: 'string|null', default: 'null')]
    public string $href = 'URL for navigation items.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the item.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $value = 'Value passed on selection (defaults to label).';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Custom content (overrides default layout).';

    #[Story('Basic Item', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2 space-y-1">
            <twig:ui:command-palette:item label="Simple Item" />
            <twig:ui:command-palette:item icon="lucide:file" label="With Icon" />
            <twig:ui:command-palette:item icon="lucide:save" label="With Shortcut" shortcut="⌘ + S" />
        </div>
        TWIG);
    }

    #[Story('With Description', order: 1)]
    public function withDescription(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2 space-y-1">
            <twig:ui:command-palette:item
                icon="lucide:settings"
                label="Settings"
                description="Configure your preferences and account"
            />
            <twig:ui:command-palette:item
                icon="lucide:help-circle"
                label="Help Center"
                description="View documentation and FAQs"
            />
        </div>
        TWIG);
    }

    #[Story('As Links', order: 2)]
    public function asLinks(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2 space-y-1">
            <twig:ui:command-palette:item
                icon="lucide:external-link"
                label="Documentation"
                description="Opens in new tab"
                href="https://example.com"
            />
            <twig:ui:command-palette:item
                icon="lucide:github"
                label="GitHub Repository"
                href="https://github.com"
            />
        </div>
        TWIG);
    }

    #[Story('Disabled State', order: 3)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2 space-y-1">
            <twig:ui:command-palette:item icon="lucide:check" label="Available Action" />
            <twig:ui:command-palette:item icon="lucide:lock" label="Premium Feature" description="Upgrade to access" disabled />
            <twig:ui:command-palette:item icon="lucide:trash" label="Delete All" description="No items to delete" disabled />
        </div>
        TWIG);
    }

    #[Story('With Keyboard Shortcuts', order: 4)]
    public function shortcuts(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2 space-y-1">
            <twig:ui:command-palette:item icon="lucide:copy" label="Copy" shortcut="⌘ + C" />
            <twig:ui:command-palette:item icon="lucide:scissors" label="Cut" shortcut="⌘ + X" />
            <twig:ui:command-palette:item icon="lucide:clipboard" label="Paste" shortcut="⌘ + V" />
            <twig:ui:command-palette:item icon="lucide:rotate-ccw" label="Undo" shortcut="⌘ + Z" />
            <twig:ui:command-palette:item icon="lucide:rotate-cw" label="Redo" shortcut="⌘ + ⇧ + Z" />
        </div>
        TWIG);
    }
}
