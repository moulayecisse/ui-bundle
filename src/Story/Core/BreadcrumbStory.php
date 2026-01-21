<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'breadcrumb',
    category: 'core',
    label: 'Breadcrumb',
    description: 'Navigation breadcrumb trail showing page hierarchy'
)]
class BreadcrumbStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of breadcrumb items with label, href, icon.';

    #[Prop(type: 'string', default: "'heroicons:chevron-right'")]
    public string $separator = 'Icon name for separator.';

    #[Prop(type: 'string', default: "'heroicons:home'")]
    public string $homeIcon = 'Icon for home/first item.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showHomeIcon = 'Show icon on first item.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Text and icon size.';

    #[Prop(type: "'default'|'pills'|'bordered'", default: "'default'")]
    public string $variant = 'Visual style variant.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $maxItems = 'Max items to show (truncates middle).';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Breadcrumb', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:breadcrumb :items="[
            { label: 'Home', href: '#' },
            { label: 'Products', href: '#' },
            { label: 'Current Page' }
        ]" />
        TWIG);
    }

    #[Story('With Icons', order: 1)]
    public function withIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:breadcrumb :items="[
            { label: 'Home', href: '#', icon: 'lucide:home' },
            { label: 'Category', href: '#', icon: 'lucide:folder' },
            { label: 'Document', icon: 'lucide:file' }
        ]" />
        TWIG);
    }

    #[Story('Size Variants', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500 mb-2">Small</p>
                <twig:ui:breadcrumb size="sm" :items="[
                    { label: 'Home', href: '#' },
                    { label: 'Products', href: '#' },
                    { label: 'Details' }
                ]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:breadcrumb size="md" :items="[
                    { label: 'Home', href: '#' },
                    { label: 'Products', href: '#' },
                    { label: 'Details' }
                ]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Large</p>
                <twig:ui:breadcrumb size="lg" :items="[
                    { label: 'Home', href: '#' },
                    { label: 'Products', href: '#' },
                    { label: 'Details' }
                ]" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Variant Styles', order: 3)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-500 mb-2">Default</p>
                <twig:ui:breadcrumb variant="default" :items="[
                    { label: 'Home', href: '#' },
                    { label: 'Products', href: '#' },
                    { label: 'Details' }
                ]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Pills</p>
                <twig:ui:breadcrumb variant="pills" :items="[
                    { label: 'Home', href: '#' },
                    { label: 'Products', href: '#' },
                    { label: 'Details' }
                ]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Bordered</p>
                <twig:ui:breadcrumb variant="bordered" :items="[
                    { label: 'Home', href: '#' },
                    { label: 'Products', href: '#' },
                    { label: 'Details' }
                ]" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Without Home Icon', order: 4)]
    public function withoutHomeIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:breadcrumb :showHomeIcon="false" :items="[
            { label: 'Home', href: '#' },
            { label: 'Products', href: '#' },
            { label: 'Details' }
        ]" />
        TWIG);
    }

    #[Story('Custom Separator', order: 5)]
    public function customSeparator(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:breadcrumb separator="lucide:slash" :items="[
            { label: 'Home', href: '#' },
            { label: 'Products', href: '#' },
            { label: 'Details' }
        ]" />
        TWIG);
    }

    #[Story('Longer Path', order: 6)]
    public function longerPath(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:breadcrumb :items="[
            { label: 'Dashboard', href: '#' },
            { label: 'Settings', href: '#' },
            { label: 'Account', href: '#' },
            { label: 'Security', href: '#' },
            { label: 'Two-Factor Auth' }
        ]" />
        TWIG);
    }
}
