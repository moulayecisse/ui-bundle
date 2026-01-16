<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'timeline',
    category: 'core',
    label: 'Timeline',
    description: 'Visual timeline for displaying chronological events or steps'
)]
class TimelineStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of timeline items with title, description, date, status, icon';

    #[Prop(type: "'vertical'|'horizontal'", default: "'vertical'")]
    public string $orientation = 'Timeline orientation';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Vertical Timeline', order: 0)]
    public function vertical(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:timeline :items="[
            { title: 'Order Placed', description: 'Your order #12345 has been placed successfully.', date: 'Jan 1, 2024', status: 'completed' },
            { title: 'Processing', description: 'Your order is being processed.', date: 'Jan 2, 2024', status: 'completed' },
            { title: 'Shipped', description: 'Your order has been shipped via Express.', date: 'Jan 3, 2024', status: 'current' },
            { title: 'Delivered', description: 'Expected delivery.', date: 'Jan 5, 2024', status: 'upcoming' }
        ]" />
        TWIG);
    }

    #[Story('Horizontal Timeline', order: 1)]
    public function horizontal(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:timeline orientation="horizontal" :items="[
            { title: 'Step 1', status: 'completed' },
            { title: 'Step 2', status: 'completed' },
            { title: 'Step 3', status: 'current' },
            { title: 'Step 4', status: 'upcoming' }
        ]" />
        TWIG);
    }

    #[Story('With Error State', order: 2)]
    public function withErrorState(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:timeline :items="[
            { title: 'Payment Initiated', status: 'completed', date: 'Jan 1' },
            { title: 'Processing', status: 'completed', date: 'Jan 2' },
            { title: 'Payment Failed', status: 'error', description: 'Insufficient funds', date: 'Jan 3' }
        ]" />
        TWIG);
    }

    #[Story('With Custom Icons', order: 3)]
    public function withCustomIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:timeline :items="[
            { title: 'Account Created', icon: 'heroicons:user-plus', status: 'completed' },
            { title: 'Email Verified', icon: 'heroicons:envelope', status: 'completed' },
            { title: 'Profile Setup', icon: 'heroicons:cog-6-tooth', status: 'current' },
            { title: 'Complete', icon: 'heroicons:rocket-launch', status: 'upcoming' }
        ]" />
        TWIG);
    }
}
