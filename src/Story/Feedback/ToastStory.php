<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'toast',
    category: 'feedback',
    label: 'Toast',
    description: 'Temporary notification messages'
)]
class ToastStory extends AbstractComponentStory
{
    #[Prop(type: "'info' | 'success' | 'warning' | 'error' | 'default'", default: "'info'")]
    public string $type = 'Toast type (determines color and icon)';

    #[Prop(type: "'default' | 'solid' | 'minimal'", default: "'default'")]
    public string $variant = 'Toast style variant';

    #[Prop(type: 'string', default: "''")]
    public string $message = 'Toast message content';

    #[Prop(type: 'string | null', default: 'null')]
    public string $title = 'Optional toast title';

    #[Prop(type: 'boolean', default: 'true')]
    public string $closable = 'Show close button';

    #[Prop(type: 'number', default: '5000')]
    public string $duration = 'Auto-dismiss duration in ms (0 = no auto-dismiss)';

    #[Prop(type: 'string | null', default: 'null')]
    public string $icon = 'Custom icon (overrides type default)';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showIcon = 'Show icon';

    #[Prop(type: 'string | null', default: 'null')]
    public string $actionLabel = 'Action button label';

    #[Prop(type: 'string | null', default: 'null')]
    public string $actionUrl = 'Action button URL';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $messageSlot = 'Toast message content (alternative to message prop)';

    #[Slot]
    public string $titleSlot = 'Toast title (alternative to title prop)';

    #[Slot]
    public string $action = 'Custom action content';

    #[Story('Toast Types', order: 0)]
    public function types(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3 max-w-sm">
            <twig:ui:toast type="info" message="This is an informational message." />
            <twig:ui:toast type="success" message="Operation completed successfully!" />
            <twig:ui:toast type="warning" message="Please review your changes before proceeding." />
            <twig:ui:toast type="error" message="An error occurred. Please try again." />
            <twig:ui:toast type="default" message="This is a default notification." />
        </div>
        TWIG);
    }

    #[Story('With Title', order: 1)]
    public function withTitle(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3 max-w-sm">
            <twig:ui:toast type="success" title="Success!" message="Your profile has been updated." />
            <twig:ui:toast type="error" title="Error" message="Failed to save changes. Please try again." />
            <twig:ui:toast type="info" title="New Update" message="A new version is available for download." />
        </div>
        TWIG);
    }

    #[Story('Solid Variant', order: 2)]
    public function solid(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3 max-w-sm">
            <twig:ui:toast type="info" variant="solid" message="Solid info toast." />
            <twig:ui:toast type="success" variant="solid" message="Solid success toast." />
            <twig:ui:toast type="warning" variant="solid" message="Solid warning toast." />
            <twig:ui:toast type="error" variant="solid" message="Solid error toast." />
        </div>
        TWIG);
    }

    #[Story('Minimal Variant', order: 3)]
    public function minimal(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3 max-w-sm">
            <twig:ui:toast type="info" variant="minimal" message="Minimal info toast." />
            <twig:ui:toast type="success" variant="minimal" message="Minimal success toast." />
        </div>
        TWIG);
    }

    #[Story('With Action', order: 4)]
    public function withAction(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3 max-w-sm">
            <twig:ui:toast type="info" title="New Message" message="You have a new message." actionLabel="View" actionUrl="#" />
            <twig:ui:toast type="warning" message="Your session will expire soon." actionLabel="Extend" actionUrl="#" />
        </div>
        TWIG);
    }

    #[Story('Not Closable', order: 5)]
    public function notClosable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:toast type="info" message="This toast cannot be dismissed manually." :closable="false" />
        </div>
        TWIG);
    }

    #[Story('Without Icon', order: 6)]
    public function noIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:toast type="info" message="This toast has no icon." :showIcon="false" />
        </div>
        TWIG);
    }

    #[Story('Custom Icon', order: 7)]
    public function customIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3 max-w-sm">
            <twig:ui:toast type="info" icon="lucide:bell" message="You have new notifications." />
            <twig:ui:toast type="success" icon="lucide:party-popper" message="Congratulations on your achievement!" />
        </div>
        TWIG);
    }

    #[Story('Toast Container Example', order: 8)]
    public function container(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="relative h-48 bg-gray-100 dark:bg-gray-900 rounded-lg overflow-hidden">
            <div class="absolute top-4 right-4 flex flex-col gap-2 w-80">
                <twig:ui:toast type="success" message="File uploaded successfully!" />
                <twig:ui:toast type="info" message="Processing your request..." />
            </div>
        </div>
        TWIG);
    }
}
