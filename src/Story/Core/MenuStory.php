<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'menu',
    category: 'core',
    label: 'Menu',
    description: 'Vertical navigation menu with nested submenus'
)]
class MenuStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes for the menu container.';

    #[Slot]
    public string $content = 'Menu items content.';

    #[Story('Basic Menu', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs bg-slate-900 dark:bg-gray-900 p-4 rounded-lg">
            <twig:ui:menu>
                <twig:ui:menu:item label="Dashboard" icon="heroicons:home" active />
                <twig:ui:menu:item label="Users" icon="heroicons:users" href="/users" />
                <twig:ui:menu:item label="Settings" icon="heroicons:cog-6-tooth" href="/settings" />
            </twig:ui:menu>
        </div>
        TWIG);
    }

    #[Story('With Badges and Counts', order: 1)]
    public function withBadgesAndCounts(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs bg-slate-900 dark:bg-gray-900 p-4 rounded-lg">
            <twig:ui:menu>
                <twig:ui:menu:item label="Inbox" icon="heroicons:inbox" badge="5" badgeVariant="error" href="/inbox" />
                <twig:ui:menu:item label="Messages" icon="heroicons:chat-bubble-left" :count="12" href="/messages" />
                <twig:ui:menu:item label="Notifications" icon="heroicons:bell" badge="New" badgeVariant="success" href="/notifications" />
                <twig:ui:menu:item label="Tasks" icon="heroicons:clipboard-document-list" :count="3" badge="!" badgeVariant="warning" href="/tasks" />
            </twig:ui:menu>
        </div>
        TWIG);
    }

    #[Story('With Submenu', order: 2)]
    public function withSubmenu(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs bg-slate-900 dark:bg-gray-900 p-4 rounded-lg">
            <twig:ui:menu>
                <twig:ui:menu:item label="Dashboard" icon="heroicons:home" href="/dashboard" />
                <twig:ui:menu:item label="Products" icon="heroicons:cube" :count="24">
                    <twig:block name="children">
                        <twig:ui:menu:sub:item label="All Products" href="/products" />
                        <twig:ui:menu:sub:item label="Categories" href="/categories" badge="3" />
                        <twig:ui:menu:sub:item label="Inventory" href="/inventory" :count="156" />
                    </twig:block>
                </twig:ui:menu:item>
                <twig:ui:menu:item label="Orders" icon="heroicons:shopping-cart" badge="New" badgeVariant="info" href="/orders" />
            </twig:ui:menu>
        </div>
        TWIG);
    }

    #[Story('Expanded Submenu', order: 3)]
    public function expandedSubmenu(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs bg-slate-900 dark:bg-gray-900 p-4 rounded-lg">
            <twig:ui:menu>
                <twig:ui:menu:item label="Settings" icon="heroicons:cog-6-tooth" :expanded="true">
                    <twig:block name="children">
                        <twig:ui:menu:sub:item label="General" href="/settings/general" active />
                        <twig:ui:menu:sub:item label="Security" href="/settings/security" />
                        <twig:ui:menu:sub:item label="Notifications" href="/settings/notifications" />
                    </twig:block>
                </twig:ui:menu:item>
            </twig:ui:menu>
        </div>
        TWIG);
    }

    #[Story('Disabled Items', order: 4)]
    public function disabledItems(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs bg-slate-900 dark:bg-gray-900 p-4 rounded-lg">
            <twig:ui:menu>
                <twig:ui:menu:item label="Dashboard" icon="heroicons:home" href="/dashboard" />
                <twig:ui:menu:item label="Analytics" icon="heroicons:chart-bar" :disabled="true" badge="Pro" badgeVariant="warning" />
                <twig:ui:menu:item label="Reports" icon="heroicons:document-chart-bar" :disabled="true" />
            </twig:ui:menu>
        </div>
        TWIG);
    }

    #[Story('Full Example', order: 5)]
    public function fullExample(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs bg-slate-900 dark:bg-gray-900 p-4 rounded-lg">
            <twig:ui:menu>
                <twig:ui:menu:item label="Dashboard" icon="heroicons:home" active href="/dashboard" />
                <twig:ui:menu:item label="Inbox" icon="heroicons:inbox" badge="12" badgeVariant="error" href="/inbox" />
                <twig:ui:menu:item label="Projects" icon="heroicons:folder" :count="8" :expanded="true">
                    <twig:block name="children">
                        <twig:ui:menu:sub:item label="Active" href="/projects/active" :count="5" />
                        <twig:ui:menu:sub:item label="Archived" href="/projects/archived" :count="3" />
                        <twig:ui:menu:sub:item label="Create New" href="/projects/new" badge="+" badgeVariant="success" />
                    </twig:block>
                </twig:ui:menu:item>
                <twig:ui:menu:item label="Team" icon="heroicons:user-group" href="/team" />
                <twig:ui:menu:item label="Billing" icon="heroicons:credit-card" :disabled="true" badge="Pro" badgeVariant="warning" />
                <twig:ui:menu:item label="Settings" icon="heroicons:cog-6-tooth" href="/settings" />
            </twig:ui:menu>
        </div>
        TWIG);
    }
}
