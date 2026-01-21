<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'container',
    category: 'core',
    label: 'Container',
    description: 'Base container component with border and shadow options'
)]
class ContainerStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'div'")]
    public string $tag = 'HTML tag for the container element.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $border = 'Show border styling.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $shadow = 'Show shadow instead of border.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $rounded = 'Apply rounded corners.';

    #[Prop(type: 'string', default: "'visible'")]
    public string $overflow = 'Overflow behavior (visible, hidden, auto, scroll).';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Main container content.';

    #[Story('Basic Container', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:container class="p-4">
            <p class="text-gray-600 dark:text-gray-400">
                Basic container with default styling (border, rounded corners, white background).
            </p>
        </twig:ui:container>
        TWIG);
    }

    #[Story('Container with Shadow', order: 1)]
    public function withShadow(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:container :border="false" :shadow="true" class="p-4">
            <p class="text-gray-600 dark:text-gray-400">
                Container with shadow instead of border. Useful for elevated content.
            </p>
        </twig:ui:container>
        TWIG);
    }

    #[Story('Container without Border', order: 2)]
    public function withoutBorder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:container :border="false" class="p-4">
            <p class="text-gray-600 dark:text-gray-400">
                Container without border, just the background and rounded corners.
            </p>
        </twig:ui:container>
        TWIG);
    }

    #[Story('Container with Overflow Hidden', order: 3)]
    public function overflowHidden(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:container overflow="hidden" class="p-4">
            <p class="text-gray-600 dark:text-gray-400">
                Container with overflow hidden. Useful for image containers or clipped content.
            </p>
        </twig:ui:container>
        TWIG);
    }

    #[Story('Custom HTML Tag', order: 4)]
    public function customTag(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:container tag="section" class="p-4">
            <p class="text-gray-600 dark:text-gray-400">
                This container renders as a &lt;section&gt; element for semantic HTML.
            </p>
        </twig:ui:container>
        TWIG);
    }

    #[Story('Style Override', order: 5)]
    public function styleOverride(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:container class="p-4 bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800">
                <p class="text-blue-700 dark:text-blue-300">Blue themed container</p>
            </twig:ui:container>
            <twig:ui:container class="p-4 bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800">
                <p class="text-green-700 dark:text-green-300">Green themed container</p>
            </twig:ui:container>
        </div>
        TWIG);
    }
}
