<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'command-palette',
    category: 'core',
    label: 'Command Palette',
    description: 'A command palette for quick navigation and actions (⌘K)'
)]
class CommandPaletteStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'Type a command or search...'")]
    public string $placeholder = 'Placeholder text for the search input.';

    #[Prop(type: 'string', default: "'k'")]
    public string $shortcut = 'Keyboard shortcut key (combined with modifier).';

    #[Prop(type: "'meta'|'ctrl'|'alt'", default: "'meta'")]
    public string $shortcutModifier = 'Modifier key for the shortcut.';

    #[Prop(type: 'string', default: "'No results found.'")]
    public string $emptyMessage = 'Message shown when no results match the search.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closeOnSelect = 'Close the palette when an item is selected.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $open = 'Initial open state.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $trigger = 'Optional trigger element (button to open the palette).';

    #[Slot]
    public string $content = 'Command groups and items.';

    #[Story('Basic Usage', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:command-palette>
            {% block trigger %}
                <button class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <twig:ux:icon name="lucide:search" class="size-4" />
                    <span>Search...</span>
                    <span class="flex items-center gap-0.5 ml-2">
                        <twig:ui:kbd size="sm">⌘</twig:ui:kbd>
                        <twig:ui:kbd size="sm">K</twig:ui:kbd>
                    </span>
                </button>
            {% endblock %}

            <twig:ui:command-palette:group heading="Suggestions">
                <twig:ui:command-palette:item icon="lucide:file-text" label="New Document" shortcut="⌘ + N" />
                <twig:ui:command-palette:item icon="lucide:folder" label="Open Project" shortcut="⌘ + O" />
                <twig:ui:command-palette:item icon="lucide:search" label="Search Files" shortcut="⌘ + P" />
            </twig:ui:command-palette:group>

            <twig:ui:command-palette:group heading="Actions">
                <twig:ui:command-palette:item icon="lucide:settings" label="Settings" description="Configure your preferences" />
                <twig:ui:command-palette:item icon="lucide:user" label="Profile" description="View and edit your profile" />
                <twig:ui:command-palette:item icon="lucide:log-out" label="Sign Out" />
            </twig:ui:command-palette:group>
        </twig:ui:command-palette>

        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            Press <twig:ui:kbd>⌘</twig:ui:kbd> <twig:ui:kbd>K</twig:ui:kbd> or click the button to open the command palette.
        </p>
        TWIG);
    }

    #[Story('With Navigation Links', order: 1)]
    public function withLinks(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:command-palette placeholder="Go to...">
            {% block trigger %}
                <button class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                    <twig:ux:icon name="lucide:compass" class="size-4" />
                    Quick Navigation
                </button>
            {% endblock %}

            <twig:ui:command-palette:group heading="Pages">
                <twig:ui:command-palette:item icon="lucide:home" label="Dashboard" href="#dashboard" />
                <twig:ui:command-palette:item icon="lucide:users" label="Users" href="#users" />
                <twig:ui:command-palette:item icon="lucide:package" label="Products" href="#products" />
                <twig:ui:command-palette:item icon="lucide:shopping-cart" label="Orders" href="#orders" />
                <twig:ui:command-palette:item icon="lucide:bar-chart-2" label="Analytics" href="#analytics" />
            </twig:ui:command-palette:group>

            <twig:ui:command-palette:group heading="Settings">
                <twig:ui:command-palette:item icon="lucide:settings" label="General Settings" href="#settings" />
                <twig:ui:command-palette:item icon="lucide:shield" label="Security" href="#security" />
                <twig:ui:command-palette:item icon="lucide:credit-card" label="Billing" href="#billing" />
            </twig:ui:command-palette:group>
        </twig:ui:command-palette>
        TWIG);
    }

    #[Story('Theme Switcher Example', order: 2)]
    public function themeSwitcher(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:command-palette placeholder="Change theme...">
            {% block trigger %}
                <button class="inline-flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                    <twig:ux:icon name="lucide:palette" class="size-5" />
                </button>
            {% endblock %}

            <twig:ui:command-palette:group heading="Appearance">
                <twig:ui:command-palette:item icon="lucide:sun" label="Light" description="Use light theme" value="light" />
                <twig:ui:command-palette:item icon="lucide:moon" label="Dark" description="Use dark theme" value="dark" />
                <twig:ui:command-palette:item icon="lucide:monitor" label="System" description="Match system preference" value="system" />
            </twig:ui:command-palette:group>
        </twig:ui:command-palette>
        TWIG);
    }

    #[Story('With Disabled Items', order: 3)]
    public function withDisabledItems(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:command-palette>
            {% block trigger %}
                <button class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                    Open Menu
                </button>
            {% endblock %}

            <twig:ui:command-palette:group heading="File">
                <twig:ui:command-palette:item icon="lucide:file-plus" label="New File" shortcut="⌘ + N" />
                <twig:ui:command-palette:item icon="lucide:save" label="Save" shortcut="⌘ + S" />
                <twig:ui:command-palette:item icon="lucide:save-all" label="Save All" shortcut="⌘ + ⇧ + S" disabled />
            </twig:ui:command-palette:group>

            <twig:ui:command-palette:group heading="Edit">
                <twig:ui:command-palette:item icon="lucide:undo" label="Undo" shortcut="⌘ + Z" />
                <twig:ui:command-palette:item icon="lucide:redo" label="Redo" shortcut="⌘ + ⇧ + Z" disabled />
                <twig:ui:command-palette:item icon="lucide:clipboard" label="Paste" shortcut="⌘ + V" />
            </twig:ui:command-palette:group>
        </twig:ui:command-palette>
        TWIG);
    }

    #[Story('Custom Trigger with Ctrl Modifier', order: 4)]
    public function ctrlModifier(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:command-palette shortcutModifier="ctrl" placeholder="Search or type a command...">
            {% block trigger %}
                <div class="flex items-center gap-3 w-64 px-3 py-2 text-sm text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <twig:ux:icon name="lucide:search" class="size-4" />
                    <span class="flex-1">Search...</span>
                    <span class="flex items-center gap-0.5">
                        <twig:ui:kbd size="sm">Ctrl</twig:ui:kbd>
                        <twig:ui:kbd size="sm">K</twig:ui:kbd>
                    </span>
                </div>
            {% endblock %}

            <twig:ui:command-palette:group heading="Recent">
                <twig:ui:command-palette:item icon="lucide:clock" label="Recently opened file.tsx" />
                <twig:ui:command-palette:item icon="lucide:clock" label="Another recent file.js" />
            </twig:ui:command-palette:group>

            <twig:ui:command-palette:group heading="Commands">
                <twig:ui:command-palette:item icon="lucide:terminal" label="Toggle Terminal" shortcut="Ctrl + `" />
                <twig:ui:command-palette:item icon="lucide:sidebar" label="Toggle Sidebar" shortcut="Ctrl + B" />
                <twig:ui:command-palette:item icon="lucide:maximize" label="Toggle Fullscreen" shortcut="F11" />
            </twig:ui:command-palette:group>
        </twig:ui:command-palette>

        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
            This example uses <twig:ui:kbd>Ctrl</twig:ui:kbd> <twig:ui:kbd>K</twig:ui:kbd> instead of <twig:ui:kbd>⌘</twig:ui:kbd> <twig:ui:kbd>K</twig:ui:kbd>.
        </p>
        TWIG);
    }

    #[Story('Search Applications', order: 5)]
    public function searchApplications(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:command-palette placeholder="Search apps..." emptyMessage="No applications found.">
            {% block trigger %}
                <button class="inline-flex items-center justify-center size-10 text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <twig:ux:icon name="lucide:grid-3x3" class="size-5" />
                </button>
            {% endblock %}

            <twig:ui:command-palette:group heading="Productivity">
                <twig:ui:command-palette:item icon="lucide:mail" label="Mail" description="Email client" />
                <twig:ui:command-palette:item icon="lucide:calendar" label="Calendar" description="Schedule and events" />
                <twig:ui:command-palette:item icon="lucide:check-square" label="Tasks" description="To-do lists" />
                <twig:ui:command-palette:item icon="lucide:sticky-note" label="Notes" description="Quick notes and memos" />
            </twig:ui:command-palette:group>

            <twig:ui:command-palette:group heading="Communication">
                <twig:ui:command-palette:item icon="lucide:message-circle" label="Chat" description="Team messaging" />
                <twig:ui:command-palette:item icon="lucide:video" label="Meet" description="Video conferencing" />
                <twig:ui:command-palette:item icon="lucide:phone" label="Phone" description="Voice calls" />
            </twig:ui:command-palette:group>

            <twig:ui:command-palette:group heading="Storage">
                <twig:ui:command-palette:item icon="lucide:hard-drive" label="Drive" description="Cloud storage" />
                <twig:ui:command-palette:item icon="lucide:image" label="Photos" description="Image gallery" />
            </twig:ui:command-palette:group>
        </twig:ui:command-palette>
        TWIG);
    }
}
