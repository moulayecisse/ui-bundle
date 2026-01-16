<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'tabs',
    category: 'core',
    label: 'Tabs',
    description: 'Tabbed navigation with various styles and orientations'
)]
class TabsStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $tabs = 'Array of tab objects with key, label, icon, badge, disabled';

    #[Prop(type: 'string', default: "''")]
    public string $current = 'Key of the currently active tab';

    #[Prop(type: "'underline'|'pills'|'boxed'", default: "'underline'")]
    public string $variant = 'Tab style variant';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Tab size (text and padding)';

    #[Prop(type: 'boolean', default: 'false')]
    public string $fullWidth = 'Stretch tabs to fill container width';

    #[Prop(type: "'horizontal'|'vertical'", default: "'horizontal'")]
    public string $orientation = 'Tab layout orientation';

    #[Prop(type: 'boolean', default: 'true')]
    public string $animated = 'Enable transition animations';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Tab items (when not using tabs prop)';

    #[Slot]
    public string $panels = 'Tab panel content';

    #[Story('Underline Variant', order: 0)]
    public function underline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            variant="underline"
            current="dashboard"
            :tabs="[
                { key: 'dashboard', label: 'Dashboard' },
                { key: 'settings', label: 'Settings' },
                { key: 'profile', label: 'Profile' }
            ]"
        />
        TWIG);
    }

    #[Story('Pills Variant', order: 1)]
    public function pills(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            variant="pills"
            current="overview"
            :tabs="[
                { key: 'overview', label: 'Overview' },
                { key: 'analytics', label: 'Analytics' },
                { key: 'reports', label: 'Reports' }
            ]"
        />
        TWIG);
    }

    #[Story('Boxed Variant', order: 2)]
    public function boxed(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            variant="boxed"
            current="monthly"
            :tabs="[
                { key: 'weekly', label: 'Weekly' },
                { key: 'monthly', label: 'Monthly' },
                { key: 'yearly', label: 'Yearly' }
            ]"
        />
        TWIG);
    }

    #[Story('With Icons', order: 3)]
    public function withIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            variant="underline"
            current="home"
            :tabs="[
                { key: 'home', label: 'Home', icon: 'lucide:home' },
                { key: 'users', label: 'Users', icon: 'lucide:users' },
                { key: 'settings', label: 'Settings', icon: 'lucide:settings' }
            ]"
        />
        TWIG);
    }

    #[Story('With Disabled Tab', order: 4)]
    public function withDisabledTab(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            variant="underline"
            current="active"
            :tabs="[
                { key: 'active', label: 'Active Tab' },
                { key: 'disabled', label: 'Disabled', disabled: true },
                { key: 'normal', label: 'Normal Tab' }
            ]"
        />
        TWIG);
    }

    #[Story('Size Variants', order: 5)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <p class="text-sm text-gray-500 mb-2">Small</p>
                <twig:ui:tabs size="sm" variant="underline" current="tab1" :tabs="[{ key: 'tab1', label: 'Tab 1' }, { key: 'tab2', label: 'Tab 2' }, { key: 'tab3', label: 'Tab 3' }]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:tabs size="md" variant="underline" current="tab1" :tabs="[{ key: 'tab1', label: 'Tab 1' }, { key: 'tab2', label: 'Tab 2' }, { key: 'tab3', label: 'Tab 3' }]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Large</p>
                <twig:ui:tabs size="lg" variant="underline" current="tab1" :tabs="[{ key: 'tab1', label: 'Tab 1' }, { key: 'tab2', label: 'Tab 2' }, { key: 'tab3', label: 'Tab 3' }]" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Full Width', order: 6)]
    public function fullWidth(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            fullWidth
            variant="boxed"
            current="tab1"
            :tabs="[
                { key: 'tab1', label: 'Account' },
                { key: 'tab2', label: 'Notifications' },
                { key: 'tab3', label: 'Security' }
            ]"
        />
        TWIG);
    }

    #[Story('With Badges', order: 7)]
    public function withBadges(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            variant="underline"
            current="inbox"
            :tabs="[
                { key: 'inbox', label: 'Inbox', badge: '12' },
                { key: 'drafts', label: 'Drafts', badge: '3' },
                { key: 'sent', label: 'Sent' }
            ]"
        />
        TWIG);
    }

    #[Story('Vertical Orientation', order: 8)]
    public function vertical(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:tabs
            orientation="vertical"
            variant="pills"
            current="general"
            :tabs="[
                { key: 'general', label: 'General', icon: 'lucide:settings' },
                { key: 'security', label: 'Security', icon: 'lucide:shield' },
                { key: 'notifications', label: 'Notifications', icon: 'lucide:bell' },
                { key: 'billing', label: 'Billing', icon: 'lucide:credit-card' }
            ]"
        >
            <twig:block name="panels">
                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <p class="text-gray-600 dark:text-gray-400">Tab panel content goes here...</p>
                </div>
            </twig:block>
        </twig:ui:tabs>
        TWIG);
    }
}
