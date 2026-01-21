<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'stat/item',
    category: 'core',
    label: 'Stat Item',
    description: 'Individual statistic display with icon, value, and trend indicator'
)]
class StatItemStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $label = 'Stat label/title.';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Main value to display.';

    #[Prop(type: 'string', default: "''")]
    public string $description = 'Optional description text.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $icon = 'Icon name (e.g., "heroicons:users").';

    #[Prop(type: "'up'|'down'|'neutral'|null", default: 'null')]
    public string $trend = 'Trend direction (auto-detected from change if not set).';

    #[Prop(type: "'xs'|'sm'|'md'|'lg'|'xl'", default: "'md'")]
    public string $size = 'Stat size.';

    #[Prop(type: "'default'|'outline'|'flat'|'glass'", default: "'default'")]
    public string $variant = 'Card variant style.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[NestedAttribute]
    public string $iconAttr = 'Icon positioning and styling (position, color, rounded, hideBg).';

    #[NestedAttribute]
    public string $valueAttr = 'Value prefix and suffix.';

    #[NestedAttribute]
    public string $labelAttr = 'Label positioning (first).';

    #[NestedAttribute]
    public string $trendAttr = 'Trend options (change, label, only, hideIcon, invertColors).';

    #[NestedAttribute]
    public string $cardAttr = 'Card options (clickable, centered, compact).';

    #[Story('Basic Stat Item', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:stat:item label="Total Users" value="1,234" />
        </div>
        TWIG);
    }

    #[Story('With Icon', order: 1)]
    public function withIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <twig:ui:stat:item label="Users" value="1,234" icon="heroicons:users" />
            <twig:ui:stat:item label="Revenue" value="$12.5k" icon="heroicons:banknotes" icon:color="success" />
            <twig:ui:stat:item label="Orders" value="456" icon="heroicons:shopping-cart" icon:color="info" />
        </div>
        TWIG);
    }

    #[Story('With Change Indicator', order: 2)]
    public function withChange(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <twig:ui:stat:item label="Revenue" value="$45,231" icon="heroicons:currency-dollar" trend:change="12.5" trend:label="vs last month" />
            <twig:ui:stat:item label="Expenses" value="$12,450" icon="heroicons:arrow-trending-down" trend:change="-8.2" trend:label="vs last month" icon:color="danger" />
            <twig:ui:stat:item label="Profit" value="$32,781" icon="heroicons:chart-bar" trend:change="0" trend:label="no change" icon:color="success" />
        </div>
        TWIG);
    }

    #[Story('Icon Positions', order: 3)]
    public function iconPositions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:stat:item label="Top (default)" value="1,234" icon="heroicons:users" icon:position="top" />
            <twig:ui:stat:item label="Left" value="1,234" icon="heroicons:users" icon:position="left" />
            <twig:ui:stat:item label="Right" value="1,234" icon="heroicons:users" icon:position="right" />
            <twig:ui:stat:item label="Bottom" value="1,234" icon="heroicons:users" icon:position="bottom" />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <twig:ui:stat:item label="Extra Small" value="123" icon="heroicons:star" size="xs" />
                <twig:ui:stat:item label="Small" value="456" icon="heroicons:star" size="sm" />
                <twig:ui:stat:item label="Medium" value="789" icon="heroicons:star" size="md" />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <twig:ui:stat:item label="Large" value="1,234" icon="heroicons:star" size="lg" />
                <twig:ui:stat:item label="Extra Large" value="5,678" icon="heroicons:star" size="xl" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Icon Colors', order: 5)]
    public function iconColors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            <twig:ui:stat:item label="Primary" value="100" icon="heroicons:star" icon:color="primary" />
            <twig:ui:stat:item label="Secondary" value="200" icon="heroicons:star" icon:color="secondary" />
            <twig:ui:stat:item label="Success" value="300" icon="heroicons:star" icon:color="success" />
            <twig:ui:stat:item label="Warning" value="400" icon="heroicons:star" icon:color="warning" />
            <twig:ui:stat:item label="Danger" value="500" icon="heroicons:star" icon:color="danger" />
            <twig:ui:stat:item label="Info" value="600" icon="heroicons:star" icon:color="info" />
        </div>
        TWIG);
    }

    #[Story('Card Variants', order: 6)]
    public function cardVariants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:stat:item label="Default" value="1,234" icon="heroicons:chart-bar" variant="default" />
            <twig:ui:stat:item label="Outline" value="1,234" icon="heroicons:chart-bar" variant="outline" />
            <twig:ui:stat:item label="Flat" value="1,234" icon="heroicons:chart-bar" variant="flat" />
            <div class="bg-gradient-to-r from-primary to-secondary rounded-xl p-1">
                <twig:ui:stat:item label="Glass" value="1,234" icon="heroicons:chart-bar" variant="glass" class="text-white" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Prefix/Suffix', order: 7)]
    public function prefixSuffix(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <twig:ui:stat:item label="Revenue" value="45,231" value:prefix="$" icon="heroicons:currency-dollar" icon:color="success" />
            <twig:ui:stat:item label="Growth" value="12.5" value:suffix="%" icon="heroicons:arrow-trending-up" icon:color="info" />
            <twig:ui:stat:item label="Average" value="4.8" value:suffix="/5" icon="heroicons:star" icon:color="warning" />
        </div>
        TWIG);
    }

    #[Story('Clickable', order: 8)]
    public function clickable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:stat:item label="View Details" value="1,234" icon="heroicons:arrow-right" card:clickable="true" />
        </div>
        TWIG);
    }

    #[Story('Label First', order: 9)]
    public function labelFirst(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:stat:item label="Value First (default)" value="1,234" icon="heroicons:star" />
            <twig:ui:stat:item label="Label First" value="1,234" icon="heroicons:star" label:first="true" />
        </div>
        TWIG);
    }

    #[Story('Trend Options', order: 10)]
    public function trendOptions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <twig:ui:stat:item label="With Change" value="1,234" trend:change="5.2" />
            <twig:ui:stat:item label="Trend Only" value="1,234" trend="up" trend:only="true" />
            <twig:ui:stat:item label="Hide Icon" value="1,234" trend:change="3.5" trend:hideIcon="true" />
            <twig:ui:stat:item label="Inverted" value="1,234" trend:change="-2.1" trend:invertColors="true" />
        </div>
        TWIG);
    }
}
