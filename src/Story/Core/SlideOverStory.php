<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'slide-over',
    category: 'core',
    label: 'Slide Over',
    description: 'Side panel that slides in from the edge of the screen'
)]
class SlideOverStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $title = 'The title displayed in the slide-over header';

    #[Prop(type: 'string', default: "''")]
    public string $description = 'Optional description text below the title';

    #[Prop(type: "'right'|'left'", default: "'right'")]
    public string $position = 'Which side the panel slides in from';

    #[Prop(type: "'sm'|'default'|'lg'|'xl'|'full'", default: "'default'")]
    public string $size = 'Width of the slide-over panel';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closeOnBackdrop = 'Close when clicking the backdrop';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closeOnEscape = 'Close when pressing Escape key';

    #[Prop(type: 'boolean', default: 'false')]
    public string $open = 'Initial open state of the panel';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $trigger = 'The element that triggers opening the slide-over';

    #[Slot]
    public string $content = 'The main content of the slide-over panel (default slot)';

    #[Slot]
    public string $footer = 'Optional footer area for action buttons';

    #[Story('Basic Slide Over', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:slide-over title="Panel Title" description="A description for the slide-over panel.">
            <twig:block name="trigger">
                <twig:ui:button>Open Slide-over</twig:ui:button>
            </twig:block>
            <p class="text-gray-700 dark:text-gray-300">
                This is the slide-over content. You can put any content here like forms, details, or navigation.
            </p>
        </twig:ui:slide-over>
        TWIG);
    }

    #[Story('Left Position', order: 1)]
    public function leftPosition(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:slide-over title="Left Panel" position="left">
            <twig:block name="trigger">
                <twig:ui:button variant="outline">Open from Left</twig:ui:button>
            </twig:block>
            <p class="text-gray-700 dark:text-gray-300">This panel slides in from the left.</p>
        </twig:ui:slide-over>
        TWIG);
    }

    #[Story('Size Options', order: 2)]
    public function sizeOptions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Slide-over supports different sizes:
            </p>
            <div class="grid grid-cols-4 gap-2 text-center text-xs">
                <div class="bg-white dark:bg-gray-900 rounded p-2">sm<br><span class="text-gray-400">max-w-md</span></div>
                <div class="bg-white dark:bg-gray-900 rounded p-2">default<br><span class="text-gray-400">max-w-2xl</span></div>
                <div class="bg-white dark:bg-gray-900 rounded p-2">lg<br><span class="text-gray-400">max-w-4xl</span></div>
                <div class="bg-white dark:bg-gray-900 rounded p-2">xl<br><span class="text-gray-400">max-w-6xl</span></div>
            </div>
        </div>
        TWIG);
    }

    #[Story('With Footer', order: 3)]
    public function withFooter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Add a footer block for action buttons:
            </p>
            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border-t-2 border-gray-200 dark:border-gray-700">
                <div class="flex justify-end gap-3">
                    <twig:ui:button variant="outline" size="sm">Cancel</twig:ui:button>
                    <twig:ui:button size="sm">Save Changes</twig:ui:button>
                </div>
            </div>
        </div>
        TWIG);
    }
}
