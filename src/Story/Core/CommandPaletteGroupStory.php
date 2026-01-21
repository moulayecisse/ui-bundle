<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'command-palette/group',
    category: 'core',
    label: 'Command Palette Group',
    description: 'A group of related commands within a command palette'
)]
class CommandPaletteGroupStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $heading = 'Optional heading for the group.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Command palette items.';

    #[Story('Basic Group', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2">
            <twig:ui:command-palette:group heading="Navigation">
                <twig:ui:command-palette:item icon="lucide:home" label="Home" />
                <twig:ui:command-palette:item icon="lucide:settings" label="Settings" />
                <twig:ui:command-palette:item icon="lucide:user" label="Profile" />
            </twig:ui:command-palette:group>
        </div>
        TWIG);
    }

    #[Story('Without Heading', order: 1)]
    public function withoutHeading(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-2">
            <twig:ui:command-palette:group>
                <twig:ui:command-palette:item icon="lucide:search" label="Search" shortcut="⌘ + K" />
                <twig:ui:command-palette:item icon="lucide:command" label="Commands" shortcut="⌘ + ⇧ + P" />
            </twig:ui:command-palette:group>
        </div>
        TWIG);
    }
}
