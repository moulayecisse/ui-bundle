<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'stat',
    category: 'core',
    label: 'Stat',
    description: 'Responsive grid container for multiple stat items'
)]
class StatStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of stat items with label, value, icon, change, etc.';

    #[Prop(type: 'number', default: '4')]
    public string $cols = 'Number of columns in the grid.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Stats Grid', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:stat :items="[
            { label: 'Total Revenue', value: '45,231', prefix: '$', icon: 'heroicons:currency-dollar' },
            { label: 'Active Users', value: '2,350', icon: 'heroicons:users' },
            { label: 'Pending Orders', value: '12', icon: 'heroicons:shopping-cart' },
            { label: 'Conversion Rate', value: '3.2', suffix: '%', icon: 'heroicons:chart-bar' }
        ]" />
        TWIG);
    }

    #[Story('With Trends', order: 1)]
    public function withTrends(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:stat :items="[
            { label: 'Revenue', value: '45,231', prefix: '$', change: 12.5, changeLabel: 'vs last month' },
            { label: 'Orders', value: '1,250', change: -3.2, changeLabel: 'vs last month' },
            { label: 'Customers', value: '8,400', change: 8.1, changeLabel: 'vs last month' }
        ]" cols="3" />
        TWIG);
    }

    #[Story('Single Stat Item', order: 2)]
    public function singleItem(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:stat:item
                label="Total Sales"
                value="12,345"
                value:prefix="$"
                icon="heroicons:banknotes"
                trend:change="8.2"
                trend:label="from last week"
            />
        </div>
        TWIG);
    }

    #[Story('Icon Positions', order: 3)]
    public function iconPositions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:stat:item label="Top Icon" value="1,234" icon="heroicons:star" icon:position="top" />
            <twig:ui:stat:item label="Left Icon" value="1,234" icon="heroicons:star" icon:position="left" />
        </div>
        TWIG);
    }

    #[Story('Variants', order: 4)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-3 gap-4">
            <twig:ui:stat:item label="Default" value="1,234" variant="default" />
            <twig:ui:stat:item label="Outline" value="1,234" variant="outline" />
            <twig:ui:stat:item label="Flat" value="1,234" variant="flat" />
        </div>
        TWIG);
    }

    #[Story('Icon Colors', order: 5)]
    public function iconColors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-3 gap-4">
            <twig:ui:stat:item label="Primary" value="100" icon="heroicons:star" icon:color="primary" />
            <twig:ui:stat:item label="Success" value="200" icon="heroicons:check-circle" icon:color="success" />
            <twig:ui:stat:item label="Warning" value="50" icon="heroicons:exclamation-triangle" icon:color="warning" />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 6)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:stat:item label="Small" value="123" size="sm" />
            <twig:ui:stat:item label="Medium" value="456" size="md" />
            <twig:ui:stat:item label="Large" value="789" size="lg" />
        </div>
        TWIG);
    }

    #[Story('Card Options', order: 7)]
    public function cardOptions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:stat:item label="Clickable" value="1,234" icon="heroicons:cursor-arrow-rays" card:clickable="true" />
            <twig:ui:stat:item label="Centered" value="5,678" icon="heroicons:arrows-pointing-in" icon:position="left" card:centered="true" />
        </div>
        TWIG);
    }

    #[Story('Label First', order: 8)]
    public function labelFirst(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:stat:item label="Label After (default)" value="1,234" />
            <twig:ui:stat:item label="Label First" value="1,234" label:first="true" />
        </div>
        TWIG);
    }

    #[Story('Trend Options', order: 9)]
    public function trendOptions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-3 gap-4">
            <twig:ui:stat:item label="With Change" value="1,234" trend:change="5.2" />
            <twig:ui:stat:item label="Trend Only" value="1,234" trend="up" trend:only="true" />
            <twig:ui:stat:item label="Inverted Colors" value="1,234" trend:change="-3.1" trend:invertColors="true" />
        </div>
        TWIG);
    }
}
