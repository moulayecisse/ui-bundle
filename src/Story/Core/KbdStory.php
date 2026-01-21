<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'kbd',
    category: 'core',
    label: 'Kbd',
    description: 'Display keyboard keys and shortcuts'
)]
class KbdStory extends AbstractComponentStory
{
    #[Prop(type: "'sm'|'default'|'lg'", default: "'default'")]
    public string $size = 'Key size.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Key label (default slot).';

    #[Story('Basic Keys', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-2">
            <twig:ui:kbd>A</twig:ui:kbd>
            <twig:ui:kbd>B</twig:ui:kbd>
            <twig:ui:kbd>C</twig:ui:kbd>
            <twig:ui:kbd>Enter</twig:ui:kbd>
            <twig:ui:kbd>Space</twig:ui:kbd>
            <twig:ui:kbd>Tab</twig:ui:kbd>
        </div>
        TWIG);
    }

    #[Story('Modifier Keys', order: 1)]
    public function modifiers(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-2">
            <twig:ui:kbd>⌘</twig:ui:kbd>
            <twig:ui:kbd>Ctrl</twig:ui:kbd>
            <twig:ui:kbd>Alt</twig:ui:kbd>
            <twig:ui:kbd>Shift</twig:ui:kbd>
            <twig:ui:kbd>⌥</twig:ui:kbd>
            <twig:ui:kbd>⇧</twig:ui:kbd>
        </div>
        TWIG);
    }

    #[Story('Arrow Keys', order: 2)]
    public function arrows(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-2">
            <twig:ui:kbd>↑</twig:ui:kbd>
            <twig:ui:kbd>↓</twig:ui:kbd>
            <twig:ui:kbd>←</twig:ui:kbd>
            <twig:ui:kbd>→</twig:ui:kbd>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-3">
            <twig:ui:kbd size="sm">⌘</twig:ui:kbd>
            <twig:ui:kbd size="default">⌘</twig:ui:kbd>
            <twig:ui:kbd size="lg">⌘</twig:ui:kbd>
        </div>
        TWIG);
    }

    #[Story('Keyboard Shortcuts', order: 4)]
    public function shortcuts(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-col gap-3">
            <div class="flex items-center gap-1">
                <twig:ui:kbd>⌘</twig:ui:kbd>
                <span class="text-gray-500 dark:text-gray-400">+</span>
                <twig:ui:kbd>K</twig:ui:kbd>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Command palette</span>
            </div>
            <div class="flex items-center gap-1">
                <twig:ui:kbd>⌘</twig:ui:kbd>
                <span class="text-gray-500 dark:text-gray-400">+</span>
                <twig:ui:kbd>S</twig:ui:kbd>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Save</span>
            </div>
            <div class="flex items-center gap-1">
                <twig:ui:kbd>⌘</twig:ui:kbd>
                <span class="text-gray-500 dark:text-gray-400">+</span>
                <twig:ui:kbd>⇧</twig:ui:kbd>
                <span class="text-gray-500 dark:text-gray-400">+</span>
                <twig:ui:kbd>P</twig:ui:kbd>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Quick open</span>
            </div>
            <div class="flex items-center gap-1">
                <twig:ui:kbd>Ctrl</twig:ui:kbd>
                <span class="text-gray-500 dark:text-gray-400">+</span>
                <twig:ui:kbd>C</twig:ui:kbd>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Copy</span>
            </div>
            <div class="flex items-center gap-1">
                <twig:ui:kbd>Ctrl</twig:ui:kbd>
                <span class="text-gray-500 dark:text-gray-400">+</span>
                <twig:ui:kbd>V</twig:ui:kbd>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Paste</span>
            </div>
        </div>
        TWIG);
    }

    #[Story('Function Keys', order: 5)]
    public function functionKeys(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-2">
            <twig:ui:kbd>F1</twig:ui:kbd>
            <twig:ui:kbd>F2</twig:ui:kbd>
            <twig:ui:kbd>F3</twig:ui:kbd>
            <twig:ui:kbd>F4</twig:ui:kbd>
            <twig:ui:kbd>F5</twig:ui:kbd>
            <twig:ui:kbd>F6</twig:ui:kbd>
            <twig:ui:kbd>F7</twig:ui:kbd>
            <twig:ui:kbd>F8</twig:ui:kbd>
            <twig:ui:kbd>F9</twig:ui:kbd>
            <twig:ui:kbd>F10</twig:ui:kbd>
            <twig:ui:kbd>F11</twig:ui:kbd>
            <twig:ui:kbd>F12</twig:ui:kbd>
        </div>
        TWIG);
    }

    #[Story('Special Keys', order: 6)]
    public function specialKeys(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-2">
            <twig:ui:kbd>Esc</twig:ui:kbd>
            <twig:ui:kbd>Backspace</twig:ui:kbd>
            <twig:ui:kbd>Delete</twig:ui:kbd>
            <twig:ui:kbd>Home</twig:ui:kbd>
            <twig:ui:kbd>End</twig:ui:kbd>
            <twig:ui:kbd>PgUp</twig:ui:kbd>
            <twig:ui:kbd>PgDn</twig:ui:kbd>
        </div>
        TWIG);
    }

    #[Story('In Context', order: 7)]
    public function inContext(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <p class="text-sm text-gray-700 dark:text-gray-300">
            Press <twig:ui:kbd>⌘</twig:ui:kbd> <twig:ui:kbd>K</twig:ui:kbd> to open the command palette,
            or use <twig:ui:kbd>Esc</twig:ui:kbd> to close it.
        </p>
        TWIG);
    }
}
