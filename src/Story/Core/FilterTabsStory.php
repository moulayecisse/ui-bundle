<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'filter-tabs',
    category: 'core',
    label: 'Filter Tabs',
    description: 'Tab-style filter buttons for data filtering'
)]
class FilterTabsStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $name = 'Form input name.';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Currently selected value.';

    #[Prop(type: 'array', default: '[]')]
    public string $options = 'Array of options with key, label, count, icon.';

    #[Prop(type: "'pills'|'underline'|'boxed'", default: "'pills'")]
    public string $variant = 'Visual style variant.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Tab size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $fullWidth = 'Stretch tabs to full container width.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Pills Variant (Default)', order: 0)]
    public function pills(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:filter-tabs
            name="status"
            value="all"
            :options="[
                { key: 'all', label: 'All' },
                { key: 'active', label: 'Active' },
                { key: 'pending', label: 'Pending' },
                { key: 'archived', label: 'Archived' }
            ]"
        />
        TWIG);
    }

    #[Story('With Counts', order: 1)]
    public function withCounts(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:filter-tabs
            name="orders"
            value="all"
            :options="[
                { key: 'all', label: 'All', count: 156 },
                { key: 'pending', label: 'Pending', count: 23 },
                { key: 'processing', label: 'Processing', count: 12 },
                { key: 'completed', label: 'Completed', count: 121 }
            ]"
        />
        TWIG);
    }

    #[Story('With Icons', order: 2)]
    public function withIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:filter-tabs
            name="view"
            value="list"
            :options="[
                { key: 'list', label: 'List', icon: 'heroicons:list-bullet' },
                { key: 'grid', label: 'Grid', icon: 'heroicons:squares-2x2' },
                { key: 'calendar', label: 'Calendar', icon: 'heroicons:calendar' }
            ]"
        />
        TWIG);
    }

    #[Story('Underline Variant', order: 3)]
    public function underline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:filter-tabs
            name="tab"
            value="overview"
            variant="underline"
            :options="[
                { key: 'overview', label: 'Overview' },
                { key: 'analytics', label: 'Analytics' },
                { key: 'reports', label: 'Reports' },
                { key: 'settings', label: 'Settings' }
            ]"
        />
        TWIG);
    }

    #[Story('Boxed Variant', order: 4)]
    public function boxed(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:filter-tabs
            name="period"
            value="month"
            variant="boxed"
            :options="[
                { key: 'day', label: 'Day' },
                { key: 'week', label: 'Week' },
                { key: 'month', label: 'Month' },
                { key: 'year', label: 'Year' }
            ]"
        />
        TWIG);
    }

    #[Story('Full Width', order: 5)]
    public function fullWidth(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:filter-tabs
                name="type"
                value="all"
                fullWidth
                :options="[
                    { key: 'all', label: 'All' },
                    { key: 'images', label: 'Images' },
                    { key: 'videos', label: 'Videos' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 6)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:filter-tabs
                name="size-sm"
                value="a"
                size="sm"
                :options="[{ key: 'a', label: 'Option A' }, { key: 'b', label: 'Option B' }]"
            />
            <twig:ui:filter-tabs
                name="size-md"
                value="a"
                size="md"
                :options="[{ key: 'a', label: 'Option A' }, { key: 'b', label: 'Option B' }]"
            />
            <twig:ui:filter-tabs
                name="size-lg"
                value="a"
                size="lg"
                :options="[{ key: 'a', label: 'Option A' }, { key: 'b', label: 'Option B' }]"
            />
        </div>
        TWIG);
    }
}
