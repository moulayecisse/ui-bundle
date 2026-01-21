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
    name: 'page-hero',
    category: 'layout',
    label: 'Page Hero',
    description: 'Hero section for page headers with gradient background and stats'
)]
class PageHeroStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $title = 'Hero title text.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $subtitle = 'Subtitle text below title.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $badge = 'Badge text displayed above title.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $badgeIcon = 'SVG icon path for badge.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showBlobs = 'Show animated background blobs.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showWave = 'Show wave decoration at bottom.';

    #[Prop(type: 'array', default: '[]')]
    public string $stats = 'Stats array: { label, value, icon? }.';

    #[Prop(type: 'string', default: "'primary'")]
    public string $colorScheme = 'Color theme: primary, cyan, violet, emerald, rose, amber, blue, teal.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Additional content below stats.';

    #[NestedAttribute]
    public string $header = 'Customize the header section.';

    #[NestedAttribute]
    public string $badgeAttr = 'Customize the badge container.';

    #[NestedAttribute]
    public string $statsAttr = 'Customize the stats grid.';

    #[NestedAttribute]
    public string $contentAttr = 'Customize the content wrapper.';

    #[Story('Basic Hero', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="rounded-lg overflow-hidden">
            <twig:ui:layout:page-hero
                title="Welcome Back!"
                subtitle="Here's what's happening with your projects today"
            />
        </div>
        TWIG);
    }

    #[Story('With Badge', order: 1)]
    public function withBadge(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="rounded-lg overflow-hidden">
            <twig:ui:layout:page-hero
                title="Dashboard Overview"
                subtitle="Your analytics at a glance"
                badge="Pro Plan"
            />
        </div>
        TWIG);
    }

    #[Story('With Stats', order: 2)]
    public function withStats(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="rounded-lg overflow-hidden">
            <twig:ui:layout:page-hero
                title="Monthly Report"
                subtitle="Performance metrics for this month"
                :stats="[
                    { label: 'Total Users', value: '12,543' },
                    { label: 'Revenue', value: '$45.2K' },
                    { label: 'Growth', value: '+23%' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Color Schemes', order: 3)]
    public function colorSchemes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="rounded-lg overflow-hidden">
                <twig:ui:layout:page-hero title="Primary Theme" colorScheme="primary" :showWave="false" />
            </div>
            <div class="rounded-lg overflow-hidden">
                <twig:ui:layout:page-hero title="Violet Theme" colorScheme="violet" :showWave="false" />
            </div>
            <div class="rounded-lg overflow-hidden">
                <twig:ui:layout:page-hero title="Emerald Theme" colorScheme="emerald" :showWave="false" />
            </div>
            <div class="rounded-lg overflow-hidden">
                <twig:ui:layout:page-hero title="Rose Theme" colorScheme="rose" :showWave="false" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Without Decorations', order: 4)]
    public function simple(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="rounded-lg overflow-hidden">
            <twig:ui:layout:page-hero
                title="Simple Hero"
                subtitle="Clean and minimal"
                :showBlobs="false"
                :showWave="false"
            />
        </div>
        TWIG);
    }
}
