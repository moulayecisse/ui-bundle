<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'responsive-list',
    category: 'core',
    label: 'Responsive List',
    description: 'Automatically switches between table (desktop) and cards (mobile)'
)]
class ResponsiveListStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of items to display';

    #[Prop(type: 'array', default: '[]')]
    public string $fields = 'Array of field definitions (name, label)';

    #[Prop(type: 'string', default: "'id'")]
    public string $keyField = 'Field to use as unique key for each item';

    #[Prop(type: 'boolean', default: 'false')]
    public string $selectable = 'Enable row selection';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showActions = 'Show actions column/section';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loading = 'Show loading skeleton';

    #[Prop(type: 'number', default: '5')]
    public string $loadingRows = 'Number of skeleton rows when loading';

    #[Prop(type: "'sm'|'md'|'lg'|'xl'", default: "'md'")]
    public string $breakpoint = 'Breakpoint to switch from cards to table';

    #[Prop(type: 'string', default: "'No items found'")]
    public string $emptyLabel = 'Text to show when no items';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $thead = 'Custom table header content';

    #[Slot]
    public string $tbody = 'Custom table body content';

    #[Slot]
    public string $tfoot = 'Custom table footer content';

    #[Slot]
    public string $tbody_actions = 'Action buttons for table rows';

    #[Slot]
    public string $mobile_content = 'Custom mobile card content';

    #[Slot]
    public string $mobile_actions = 'Action buttons for mobile cards';

    #[Slot]
    public string $empty = 'Custom empty state for desktop';

    #[Slot]
    public string $mobile_empty = 'Custom empty state for mobile';

    #[Story('Basic Responsive List', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set users = [
            { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin' },
            { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'Editor' },
            { id: 3, name: 'Bob Wilson', email: 'bob@example.com', role: 'User' },
        ] %}
        <twig:ui:responsive-list
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'email', label: 'Email' },
                { name: 'role', label: 'Role' }
            ]"
            :items="users"
        />
        TWIG);
    }

    #[Story('With Actions', order: 1)]
    public function withActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set products = [
            { id: 1, product: 'Widget A', price: '$29.99', stock: '150' },
            { id: 2, product: 'Widget B', price: '$49.99', stock: '75' },
        ] %}
        <twig:ui:responsive-list
            :fields="[
                { name: 'product', label: 'Product' },
                { name: 'price', label: 'Price' },
                { name: 'stock', label: 'Stock' }
            ]"
            :items="products"
            :showActions="true"
        >
            <twig:block name="tbody_actions">
                <twig:ui:button size="sm" variant="ghost">Edit</twig:ui:button>
            </twig:block>
            <twig:block name="mobile_actions">
                <twig:ui:button size="sm" variant="outline">Edit</twig:ui:button>
            </twig:block>
        </twig:ui:responsive-list>
        TWIG);
    }

    #[Story('Custom Breakpoint', order: 2)]
    public function customBreakpoint(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set items = [
            { id: 1, title: 'Item 1', status: 'Active' },
            { id: 2, title: 'Item 2', status: 'Pending' },
        ] %}
        <div class="space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Use <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">breakpoint="lg"</code> to switch at a larger screen size.
            </p>
            <twig:ui:responsive-list
                :fields="[{ name: 'title', label: 'Title' }, { name: 'status', label: 'Status' }]"
                :items="items"
                breakpoint="lg"
            />
        </div>
        TWIG);
    }

    #[Story('Loading State', order: 3)]
    public function loading(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:responsive-list
            :fields="[{ name: 'name', label: 'Name' }, { name: 'email', label: 'Email' }]"
            :items="[]"
            :loading="true"
            :loadingRows="3"
        />
        TWIG);
    }

    #[Story('Empty State', order: 4)]
    public function empty(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:responsive-list
            :fields="[{ name: 'name', label: 'Name' }]"
            :items="[]"
            emptyLabel="No results found"
        />
        TWIG);
    }
}
