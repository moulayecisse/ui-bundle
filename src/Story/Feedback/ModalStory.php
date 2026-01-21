<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'modal',
    category: 'feedback',
    label: 'Modal',
    description: 'Overlay dialog for focused content and interactions'
)]
class ModalStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: 'null')]
    public string $title = 'Modal title in header.';

    #[Prop(type: 'string', default: 'null')]
    public string $description = 'Description text below title.';

    #[Prop(type: "'default'|'sm'|'lg'|'xl'|'full'", default: "'default'")]
    public string $size = 'Modal width size.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closeOnBackdrop = 'Close when clicking backdrop.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closeOnEscape = 'Close when pressing Escape key.';

    #[Prop(type: 'string', default: "'Close'")]
    public string $closeButtonLabel = 'Screen reader label for close button.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $hideCloseButton = 'Hide the close button entirely.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $centered = 'Center modal vertically.';

    #[Prop(type: "'inside'|'outside'", default: "'inside'")]
    public string $scrollBehavior = 'Where scrollbar appears for long content.';

    #[Prop(type: "'center'|'top'|'bottom'", default: "'center'")]
    public string $position = 'Vertical position of modal.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $fullScreen = 'Display as fullscreen modal.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $open = 'Initial open state.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $trigger = 'Element that triggers opening the modal.';

    #[Slot]
    public string $header = 'Custom header content (overrides title).';

    #[Slot]
    public string $content = 'Modal body content.';

    #[Slot]
    public string $footer = 'Footer with action buttons.';

    #[Story('Modal with Title & Footer', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:modal title="Modal Title" description="This is a description of the modal content.">
            <twig:block name="trigger">
                <twig:ui:button variant="primary">Open Modal</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This modal has a title and description in the header. The close button appears on the right.
                </p>
            </twig:block>
            <twig:block name="footer">
                <twig:ui:button variant="outline" data-action="click->cisse--ui-bundle--modal#close">Cancel</twig:ui:button>
                <twig:ui:button variant="primary">Confirm</twig:ui:button>
            </twig:block>
        </twig:ui:modal>
        TWIG);
    }

    #[Story('Simple Modal (no header)', order: 1)]
    public function simple(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:modal>
            <twig:block name="trigger">
                <twig:ui:button variant="outline">Simple Modal</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <div class="text-center py-4">
                    <twig:ux:icon name="lucide:check-circle" class="size-16 text-green-500 mx-auto mb-4" />
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Success!</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Your action was completed successfully.</p>
                    <twig:ui:button variant="primary" data-action="click->cisse--ui-bundle--modal#close">Close</twig:ui:button>
                </div>
            </twig:block>
        </twig:ui:modal>
        TWIG);
    }

    #[Story('Size Options', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:modal size="sm" title="Small Modal">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Small</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This is a small modal (max-w-md).</p>
                </twig:block>
            </twig:ui:modal>
            <twig:ui:modal size="default" title="Default Modal">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Default</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This is the default modal size (max-w-3xl).</p>
                </twig:block>
            </twig:ui:modal>
            <twig:ui:modal size="lg" title="Large Modal">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Large</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This is a large modal (max-w-5xl).</p>
                </twig:block>
            </twig:ui:modal>
            <twig:ui:modal size="xl" title="Extra Large Modal">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">XL</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This is an extra large modal (max-w-7xl).</p>
                </twig:block>
            </twig:ui:modal>
        </div>
        TWIG);
    }

    #[Story('Non-dismissible Modal', order: 3)]
    public function nonDismissible(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:modal title="Important Action" :closeOnBackdrop="false" :closeOnEscape="false">
            <twig:block name="trigger">
                <twig:ui:button variant="danger">Open Non-dismissible</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This modal cannot be closed by clicking outside or pressing Escape. You must click a button to close it.
                </p>
            </twig:block>
            <twig:block name="footer">
                <twig:ui:button variant="primary" data-action="click->cisse--ui-bundle--modal#close">I Understand</twig:ui:button>
            </twig:block>
        </twig:ui:modal>
        TWIG);
    }

    #[Story('Confirmation Dialog Style', order: 4)]
    public function confirmation(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:modal size="sm" title="Delete Item">
            <twig:block name="trigger">
                <twig:ui:button variant="danger" icon="lucide:trash">Delete</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    Are you sure you want to delete this item? This action cannot be undone.
                </p>
            </twig:block>
            <twig:block name="footer">
                <twig:ui:button variant="outline" data-action="click->cisse--ui-bundle--modal#close">Cancel</twig:ui:button>
                <twig:ui:button variant="danger">Delete</twig:ui:button>
            </twig:block>
        </twig:ui:modal>
        TWIG);
    }

    #[Story('Position Options', order: 5)]
    public function positions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:modal position="top" title="Top Position">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Top</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This modal appears at the top of the viewport.</p>
                </twig:block>
            </twig:ui:modal>
            <twig:ui:modal position="center" title="Center Position">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Center</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This modal appears centered (default).</p>
                </twig:block>
            </twig:ui:modal>
            <twig:ui:modal position="bottom" title="Bottom Position">
                <twig:block name="trigger">
                    <twig:ui:button variant="outline" size="sm">Bottom</twig:ui:button>
                </twig:block>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This modal appears at the bottom of the viewport.</p>
                </twig:block>
            </twig:ui:modal>
        </div>
        TWIG);
    }

    #[Story('Hide Close Button', order: 6)]
    public function hideCloseButton(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:modal title="No Close Button" hideCloseButton :closeOnBackdrop="false">
            <twig:block name="trigger">
                <twig:ui:button variant="outline">Open Modal</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This modal has no close button. Users must use the action buttons to close it.
                </p>
            </twig:block>
            <twig:block name="footer">
                <twig:ui:button variant="primary" data-action="click->cisse--ui-bundle--modal#close">Got it</twig:ui:button>
            </twig:block>
        </twig:ui:modal>
        TWIG);
    }

    #[Story('Fullscreen Modal', order: 7)]
    public function fullscreen(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:modal title="Fullscreen Modal" fullScreen>
            <twig:block name="trigger">
                <twig:ui:button variant="primary" icon="lucide:maximize">Fullscreen</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">
                    This modal takes up the entire screen. Great for complex forms or detailed content.
                </p>
            </twig:block>
            <twig:block name="footer">
                <twig:ui:button variant="outline" data-action="click->cisse--ui-bundle--modal#close">Close</twig:ui:button>
                <twig:ui:button variant="primary">Save</twig:ui:button>
            </twig:block>
        </twig:ui:modal>
        TWIG);
    }
}
