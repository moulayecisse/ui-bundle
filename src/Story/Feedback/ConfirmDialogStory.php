<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'confirm-dialog',
    category: 'feedback',
    label: 'Confirm Dialog',
    description: 'Confirmation dialog for destructive or important actions'
)]
class ConfirmDialogStory extends AbstractComponentStory
{
    #[Prop(type: 'boolean', default: 'false')]
    public string $open = 'Whether the dialog is visible.';

    #[Prop(type: 'string', default: "'Confirm'")]
    public string $title = 'The dialog title.';

    #[Prop(type: 'string', default: "'Are you sure...'")]
    public string $message = 'The confirmation message text.';

    #[Prop(type: 'string', default: "'Confirm'")]
    public string $confirmText = 'Text for the confirm button.';

    #[Prop(type: 'string', default: "'Cancel'")]
    public string $cancelText = 'Text for the cancel button.';

    #[Prop(type: "'info'|'danger'|'warning'|'success'", default: "'info'")]
    public string $variant = 'Visual variant affecting icon and button colors.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loading = 'Shows loading spinner and disables buttons.';

    #[Prop(type: 'string', default: 'null')]
    public string $icon = 'Override the default icon (Iconify name).';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $titleSlot = 'Custom title content (overrides title prop).';

    #[Slot]
    public string $messageSlot = 'Custom message content (overrides message prop).';

    #[Slot]
    public string $actions = 'Custom action buttons (overrides default Cancel/Confirm buttons).';

    #[Story('Variants', order: 0)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 text-center border border-gray-200 dark:border-gray-700">
                <div class="mx-auto mb-3 flex size-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                    <twig:ux:icon name="lucide:info" class="size-6 text-blue-500" />
                </div>
                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Info</h4>
                <p class="text-sm text-gray-500">variant="info"</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 text-center border border-gray-200 dark:border-gray-700">
                <div class="mx-auto mb-3 flex size-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                    <twig:ux:icon name="lucide:alert-circle" class="size-6 text-red-500" />
                </div>
                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Danger</h4>
                <p class="text-sm text-gray-500">variant="danger"</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 text-center border border-gray-200 dark:border-gray-700">
                <div class="mx-auto mb-3 flex size-12 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30">
                    <twig:ux:icon name="lucide:alert-triangle" class="size-6 text-yellow-500" />
                </div>
                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Warning</h4>
                <p class="text-sm text-gray-500">variant="warning"</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 text-center border border-gray-200 dark:border-gray-700">
                <div class="mx-auto mb-3 flex size-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                    <twig:ux:icon name="lucide:check-circle" class="size-6 text-green-500" />
                </div>
                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Success</h4>
                <p class="text-sm text-gray-500">variant="success"</p>
            </div>
        </div>
        TWIG);
    }

    #[Story('Delete Confirmation', order: 1)]
    public function deleteConfirmation(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm mx-auto text-center shadow-lg">
            <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                <twig:ux:icon name="lucide:alert-circle" class="size-8 text-red-500" />
            </div>
            <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-gray-100">Delete Item</h3>
            <p class="mb-6 text-gray-600 dark:text-gray-400">This action cannot be undone. Are you sure you want to delete this item?</p>
            <div class="flex justify-center gap-3">
                <twig:ui:button variant="outline">Cancel</twig:ui:button>
                <twig:ui:button class="bg-red-500 hover:bg-red-600 text-white">Delete</twig:ui:button>
            </div>
        </div>
        TWIG);
    }

    #[Story('Usage Example', order: 2)]
    public function usage(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                The confirm dialog is typically used inside a modal or triggered programmatically.
            </p>
            <div class="bg-white dark:bg-gray-900 rounded-lg p-4">
                <p class="text-sm font-mono text-gray-700 dark:text-gray-300">
                    Props: open, title, message, confirmText, cancelText, variant, loading, icon
                </p>
            </div>
        </div>
        TWIG);
    }
}
