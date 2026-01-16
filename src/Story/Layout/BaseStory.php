<?php

namespace Cisse\Bundle\Ui\Story\Layout;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'base',
    category: 'layout',
    label: 'Base Layout',
    description: 'Complete application layout with sidebar, header, and content area'
)]
class BaseStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'App'")]
    public string $name = 'Application name shown in sidebar header';

    #[Prop(type: 'string | null', default: 'null')]
    public string $icon = 'Icon name for app icon in sidebar';

    #[Prop(type: 'string | null', default: 'null')]
    public string $home = 'URL for logo link';

    #[Prop(type: 'boolean', default: 'true')]
    public string $dark = 'Show dark mode toggle in header';

    #[Prop(type: 'string | null', default: 'null')]
    public string $user = 'User name for header user menu';

    #[Prop(type: 'string | null', default: 'null')]
    public string $avatar = 'User avatar initials (e.g., "JD")';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $menu = 'Sidebar navigation menu content';

    #[Slot]
    public string $header_center = 'Content in the center of the header';

    #[Slot]
    public string $header_actions = 'Action buttons in the header';

    #[Slot]
    public string $sidebar_footer = 'Content at the bottom of the sidebar';

    #[Slot]
    public string $user_menu = 'Dropdown items for user menu';

    #[Slot]
    public string $content = 'Main page content area';

    #[NestedAttribute]
    public string $sidebar = 'Customize the sidebar element';

    #[NestedAttribute]
    public string $header = 'Customize the header element';

    #[NestedAttribute]
    public string $contentAttr = 'Customize the main content area';

    #[NestedAttribute]
    public string $menuAttr = 'Customize the menu container';

    #[NestedAttribute]
    public string $iconAttr = 'Customize the app icon';

    #[NestedAttribute]
    public string $darkAttr = 'Customize the dark toggle button';

    #[NestedAttribute]
    public string $avatarAttr = 'Customize the user avatar';

    #[NestedAttribute]
    public string $userAttr = 'Customize the user name and menu';

    #[Story('Overview', order: 0)]
    public function overview(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-slate-800 rounded-lg p-8 text-white">
            <h3 class="text-xl font-bold mb-4">Base Layout</h3>
            <p class="mb-4">A complete application layout with collapsible sidebar, header with user menu, and main content area.</p>
            <ul class="list-disc list-inside space-y-2 text-white/90">
                <li>Responsive sidebar with mobile support</li>
                <li>Dark mode toggle built-in</li>
                <li>User menu with avatar</li>
                <li>Customizable header actions</li>
                <li>Sidebar menu slot</li>
            </ul>
        </div>
        TWIG);
    }

    #[Story('Layout Structure', order: 1)]
    public function structure(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
            <div class="flex h-64">
                <div class="w-48 bg-slate-800 p-3 flex flex-col">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="size-6 bg-white/20 rounded"></div>
                        <span class="text-white text-sm font-semibold">App Name</span>
                    </div>
                    <div class="space-y-2">
                        <div class="h-8 bg-primary-500 rounded-lg"></div>
                        <div class="h-8 bg-white/10 rounded-lg"></div>
                        <div class="h-8 bg-white/10 rounded-lg"></div>
                    </div>
                </div>
                <div class="flex-1 flex flex-col">
                    <div class="h-12 bg-white dark:bg-slate-950 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-4">
                        <div class="size-6 bg-gray-200 dark:bg-gray-700 rounded"></div>
                        <div class="flex items-center gap-2">
                            <div class="size-6 bg-gray-200 dark:bg-gray-700 rounded"></div>
                            <div class="size-8 bg-primary-500 rounded-full"></div>
                        </div>
                    </div>
                    <div class="flex-1 bg-gray-100 dark:bg-slate-900 p-4">
                        <div class="h-full bg-white dark:bg-slate-800 rounded-lg p-4">
                            <p class="text-gray-500 text-sm">Content Area</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        TWIG);
    }

    #[Story('User Menu', order: 2)]
    public function userMenu(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                The user menu appears in the header when user or avatar is provided.
            </p>
            <div class="bg-white dark:bg-slate-950 rounded-lg p-3 inline-flex items-center gap-2 shadow">
                <div class="size-8 bg-primary-500 rounded-full flex items-center justify-center text-white text-sm font-medium">JD</div>
                <span class="text-sm text-gray-700 dark:text-gray-300">John Doe</span>
                <twig:ux:icon name="heroicons:chevron-down" class="size-4 text-gray-400" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Header Actions', order: 3)]
    public function headerActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Add custom actions to the header using the header_actions block.
            </p>
            <div class="bg-white dark:bg-slate-950 rounded-lg p-3 inline-flex items-center gap-3 shadow">
                <button class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                    <twig:ux:icon name="heroicons:bell" class="size-5 text-gray-600 dark:text-gray-400" />
                </button>
                <button class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg">
                    <twig:ux:icon name="heroicons:cog-6-tooth" class="size-5 text-gray-600 dark:text-gray-400" />
                </button>
            </div>
        </div>
        TWIG);
    }
}
