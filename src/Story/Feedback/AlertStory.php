<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'alert',
    category: 'feedback',
    label: 'Alert',
    description: 'Contextual feedback messages for user actions'
)]
class AlertStory extends AbstractComponentStory
{
    #[Prop(type: "'filled'|'outline'", default: "'filled'")]
    public string $variant = 'Alert style variant.';

    #[Prop(type: "'primary'|'secondary'|'success'|'warning'|'danger'|'info'", default: "'primary'")]
    public string $color = 'Alert color theme.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Alert size.';

    #[Prop(type: 'string', default: "''")]
    public string $title = 'Alert title.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $icon = 'Show default icon based on color.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $customIcon = 'Custom icon name (overrides default).';

    #[Prop(type: 'boolean', default: 'false')]
    public string $dismissible = 'Allow dismissing the alert.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $bordered = 'Add left border accent.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Alert content (default slot).';

    #[Slot]
    public string $titleSlot = 'Alert title (alternative to title prop).';

    #[Slot]
    public string $actions = 'Action buttons slot.';

    #[Story('Filled Variant (default)', order: 0)]
    public function filled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert color="primary" title="Primary">
                This is a primary alert message.
            </twig:ui:alert>
            <twig:ui:alert color="secondary" title="Secondary">
                This is a secondary alert message.
            </twig:ui:alert>
            <twig:ui:alert color="success" title="Success">
                Your changes have been saved successfully.
            </twig:ui:alert>
            <twig:ui:alert color="warning" title="Warning">
                Please review your input before submitting.
            </twig:ui:alert>
            <twig:ui:alert color="danger" title="Danger">
                Something went wrong. Please try again.
            </twig:ui:alert>
            <twig:ui:alert color="info" title="Information">
                This is an informational alert message.
            </twig:ui:alert>
        </div>
        TWIG);
    }

    #[Story('Outline Variant', order: 1)]
    public function outline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert variant="outline" color="primary" title="Primary">
                This is a primary outline alert.
            </twig:ui:alert>
            <twig:ui:alert variant="outline" color="success" title="Success">
                Operation completed successfully.
            </twig:ui:alert>
            <twig:ui:alert variant="outline" color="danger" title="Error">
                An error occurred during the operation.
            </twig:ui:alert>
        </div>
        TWIG);
    }

    #[Story('With Border Accent', order: 2)]
    public function bordered(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert color="info" title="Tip" bordered>
                Use the bordered style for important notices.
            </twig:ui:alert>
            <twig:ui:alert color="warning" title="Caution" bordered>
                This action cannot be undone.
            </twig:ui:alert>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert color="info" title="Small Alert" size="sm">
                This is a small alert.
            </twig:ui:alert>
            <twig:ui:alert color="info" title="Medium Alert" size="md">
                This is a medium alert (default).
            </twig:ui:alert>
            <twig:ui:alert color="info" title="Large Alert" size="lg">
                This is a large alert with more padding.
            </twig:ui:alert>
        </div>
        TWIG);
    }

    #[Story('Dismissible', order: 4)]
    public function dismissible(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert color="info" title="Dismissible Alert" dismissible>
                Click the X button to dismiss this alert.
            </twig:ui:alert>
            <twig:ui:alert color="success" title="Success" dismissible>
                Your settings have been saved.
            </twig:ui:alert>
        </div>
        TWIG);
    }

    #[Story('With Custom Icon', order: 5)]
    public function customIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert color="info" customIcon="lucide:bell" title="Notification">
                You have new notifications.
            </twig:ui:alert>
            <twig:ui:alert color="primary" customIcon="lucide:sparkles" title="New Feature">
                Check out our latest feature update!
            </twig:ui:alert>
        </div>
        TWIG);
    }

    #[Story('Without Icon', order: 6)]
    public function noIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:alert color="info" title="No Icon" :icon="false">
            This alert has no icon displayed.
        </twig:ui:alert>
        TWIG);
    }

    #[Story('Content Only (No Title)', order: 7)]
    public function contentOnly(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:alert color="info">
                This is a simple alert without a title.
            </twig:ui:alert>
            <twig:ui:alert color="warning">
                Please save your work before leaving.
            </twig:ui:alert>
        </div>
        TWIG);
    }
}
