<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'notification-list',
    category: 'feedback',
    label: 'Notification List',
    description: 'List of notification items with various states'
)]
class NotificationListStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Notification identifier.';

    #[Prop(type: "'info'|'success'|'warning'|'error'", default: "'info'")]
    public string $type = 'Notification type (affects colors and default icon).';

    #[Prop(type: 'string', default: "''")]
    public string $title = 'Notification title.';

    #[Prop(type: 'string', default: "''")]
    public string $message = 'Notification message body.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $dismissible = 'Show dismiss button.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Notification size.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $icon = 'Custom icon (overrides type default).';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showIcon = 'Show notification icon.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Notification List', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Notifications</h3>
            </div>
            <twig:ui:notification-list>
                <twig:ui:notification-item
                    title="New message"
                    message="You have a new message from John Doe"
                    time="2 minutes ago"
                    unread
                />
                <twig:ui:notification-item
                    title="Order shipped"
                    message="Your order #12345 has been shipped"
                    time="1 hour ago"
                />
                <twig:ui:notification-item
                    title="Payment received"
                    message="We received your payment of $99.00"
                    time="Yesterday"
                />
            </twig:ui:notification-list>
        </div>
        TWIG);
    }

    #[Story('With Icons', order: 1)]
    public function withIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <twig:ui:notification-list>
                <twig:ui:notification-item
                    title="New comment"
                    message="Someone commented on your post"
                    time="Just now"
                    icon="heroicons:chat-bubble-left-ellipsis"
                    unread
                />
                <twig:ui:notification-item
                    title="New follower"
                    message="Jane started following you"
                    time="5 min ago"
                    icon="heroicons:user-plus"
                />
                <twig:ui:notification-item
                    title="Like"
                    message="Your photo was liked by 5 people"
                    time="1 hour ago"
                    icon="heroicons:heart"
                />
            </twig:ui:notification-list>
        </div>
        TWIG);
    }

    #[Story('Type Variants', order: 2)]
    public function types(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm space-y-3">
            <twig:ui:notification-item
                type="info"
                title="Information"
                message="Here is some helpful information for you."
            />
            <twig:ui:notification-item
                type="success"
                title="Success"
                message="Your changes have been saved successfully."
            />
            <twig:ui:notification-item
                type="warning"
                title="Warning"
                message="Please review the changes before continuing."
            />
            <twig:ui:notification-item
                type="error"
                title="Error"
                message="Something went wrong. Please try again."
            />
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm space-y-3">
            <div>
                <p class="text-xs text-gray-500 mb-2">Small</p>
                <twig:ui:notification-item
                    type="success"
                    size="sm"
                    title="Small notification"
                    message="This is a compact notification."
                />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:notification-item
                    type="success"
                    size="md"
                    title="Medium notification"
                    message="This is the default notification size."
                />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Large</p>
                <twig:ui:notification-item
                    type="success"
                    size="lg"
                    title="Large notification"
                    message="This is a larger notification with more prominence."
                />
            </div>
        </div>
        TWIG);
    }
}
