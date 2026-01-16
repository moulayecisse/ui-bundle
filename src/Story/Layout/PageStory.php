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
    name: 'page',
    category: 'layout',
    label: 'Page Layout',
    description: 'Standard page layout with title, breadcrumbs, and content area'
)]
class PageStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $title = 'Page title displayed as h1';

    #[Prop(type: 'string | null', default: 'null')]
    public string $description = 'Page description below title';

    #[Prop(type: 'array', default: '[]')]
    public string $breadcrumbs = 'Array of { label, link } objects for navigation';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $actions = 'Action buttons displayed next to the title';

    #[Slot]
    public string $content = 'Main page content';

    #[NestedAttribute]
    public string $breadcrumbsAttr = 'Customize the breadcrumbs nav element';

    #[NestedAttribute]
    public string $header = 'Customize the page header container';

    #[NestedAttribute]
    public string $titleAttr = 'Customize the h1 title element';

    #[NestedAttribute]
    public string $descriptionAttr = 'Customize the description paragraph';

    #[NestedAttribute]
    public string $actionsAttr = 'Customize the actions container';

    #[NestedAttribute]
    public string $contentAttr = 'Customize the content wrapper';

    #[Story('Basic Page Layout', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden p-4">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Welcome to your dashboard overview</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                    <p class="text-gray-600 dark:text-gray-400">Page content goes here</p>
                </div>
            </div>
        </div>
        TWIG);
    }

    #[Story('With Breadcrumbs', order: 1)]
    public function withBreadcrumbs(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden p-4">
            <div class="flex flex-col gap-4">
                <nav aria-label="Breadcrumb">
                    <ol class="flex items-center">
                        <li class="flex items-center">
                            <a href="#" class="text-sm font-semibold text-gray-900 dark:text-gray-100 hover:underline">Home</a>
                        </li>
                        <li class="flex items-center">
                            <span class="mx-3 text-sm font-semibold text-gray-400 dark:text-gray-600">/</span>
                            <a href="#" class="text-sm font-semibold text-gray-900 dark:text-gray-100 hover:underline">Users</a>
                        </li>
                        <li class="flex items-center">
                            <span class="mx-3 text-sm font-semibold text-gray-400 dark:text-gray-600">/</span>
                            <a href="#" class="text-sm text-gray-400 dark:text-gray-600">Edit User</a>
                        </li>
                    </ol>
                </nav>
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit User</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Update user information</p>
                </div>
            </div>
        </div>
        TWIG);
    }

    #[Story('With Actions', order: 2)]
    public function withActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden p-4">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Products</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Manage your product catalog</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <twig:ui:button variant="outline" size="sm">Export</twig:ui:button>
                        <twig:ui:button size="sm">Add Product</twig:ui:button>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                    <p class="text-gray-600 dark:text-gray-400">Product list here</p>
                </div>
            </div>
        </div>
        TWIG);
    }
}
