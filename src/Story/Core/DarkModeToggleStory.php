<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'dark-mode-toggle',
    category: 'core',
    label: 'Dark Mode Toggle',
    description: 'Toggle button for switching between light and dark themes'
)]
class DarkModeToggleStory extends AbstractComponentStory
{
    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Toggle button size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showLabel = 'Show text label next to icon.';

    #[Prop(type: 'string', default: "'lucide:sun'")]
    public string $lightIcon = 'Icon shown in light mode.';

    #[Prop(type: 'string', default: "'lucide:moon'")]
    public string $darkIcon = 'Icon shown in dark mode.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Toggle', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center">
            <twig:ui:dark-mode-toggle />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 1)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center justify-center gap-6">
            <div class="text-center">
                <twig:ui:dark-mode-toggle size="sm" />
                <p class="mt-2 text-xs text-gray-500">Small</p>
            </div>
            <div class="text-center">
                <twig:ui:dark-mode-toggle size="md" />
                <p class="mt-2 text-xs text-gray-500">Medium</p>
            </div>
            <div class="text-center">
                <twig:ui:dark-mode-toggle size="lg" />
                <p class="mt-2 text-xs text-gray-500">Large</p>
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 2)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center">
            <twig:ui:dark-mode-toggle showLabel />
        </div>
        TWIG);
    }

    #[Story('Custom Icons', order: 3)]
    public function customIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex justify-center">
            <twig:ui:dark-mode-toggle lightIcon="lucide:sun" darkIcon="lucide:moon" />
        </div>
        TWIG);
    }
}
