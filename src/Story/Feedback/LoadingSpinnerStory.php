<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'loading-spinner',
    category: 'feedback',
    label: 'Loading Spinner',
    description: 'Animated spinner for loading states'
)]
class LoadingSpinnerStory extends AbstractComponentStory
{
    #[Prop(type: "'xs'|'sm'|'md'|'lg'|'xl'", default: "'md'")]
    public string $size = 'Spinner size.';

    #[Prop(type: "'primary'|'white'|'gray'|'current'", default: "'primary'")]
    public string $color = 'Spinner color.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $label = 'Loading text displayed below spinner.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Default', order: 0)]
    public function default(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:loading-spinner />
        TWIG);
    }

    #[Story('Sizes', order: 1)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-6">
            <div class="text-center">
                <twig:ui:loading-spinner size="xs" />
                <p class="text-xs text-gray-500 mt-2">Extra Small</p>
            </div>
            <div class="text-center">
                <twig:ui:loading-spinner size="sm" />
                <p class="text-xs text-gray-500 mt-2">Small</p>
            </div>
            <div class="text-center">
                <twig:ui:loading-spinner size="md" />
                <p class="text-xs text-gray-500 mt-2">Medium</p>
            </div>
            <div class="text-center">
                <twig:ui:loading-spinner size="lg" />
                <p class="text-xs text-gray-500 mt-2">Large</p>
            </div>
            <div class="text-center">
                <twig:ui:loading-spinner size="xl" />
                <p class="text-xs text-gray-500 mt-2">Extra Large</p>
            </div>
        </div>
        TWIG);
    }

    #[Story('Colors', order: 2)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-6">
            <div class="text-center">
                <twig:ui:loading-spinner color="primary" />
                <p class="text-xs text-gray-500 mt-2">Primary</p>
            </div>
            <div class="text-center">
                <twig:ui:loading-spinner color="gray" />
                <p class="text-xs text-gray-500 mt-2">Gray</p>
            </div>
            <div class="text-center bg-gray-800 p-4 rounded">
                <twig:ui:loading-spinner color="white" />
                <p class="text-xs text-gray-400 mt-2">White</p>
            </div>
            <div class="text-center text-blue-500">
                <twig:ui:loading-spinner color="current" />
                <p class="text-xs text-gray-500 mt-2">Current</p>
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 3)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-8">
            <twig:ui:loading-spinner label="Loading..." />
            <twig:ui:loading-spinner size="lg" label="Please wait..." />
        </div>
        TWIG);
    }

    #[Story('Inline with Text', order: 4)]
    public function inline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-2">
            <twig:ui:loading-spinner size="sm" />
            <span class="text-gray-600 dark:text-gray-400">Processing your request...</span>
        </div>
        TWIG);
    }

    #[Story('In Button', order: 5)]
    public function inButton(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex gap-4">
            <twig:ui:button color="primary" disabled>
                <twig:ui:loading-spinner size="xs" color="current" class="mr-2" />
                Saving...
            </twig:ui:button>
            <twig:ui:button variant="outline" color="neutral" disabled>
                <twig:ui:loading-spinner size="xs" color="current" class="mr-2" />
                Loading...
            </twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Full Page Loading', order: 6)]
    public function fullPage(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="relative h-48 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
            <twig:ui:loading-spinner size="xl" label="Loading content..." />
        </div>
        TWIG);
    }
}
