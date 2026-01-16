<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'data-table',
    category: 'core',
    label: 'Data Table',
    description: 'Dynamic table component with field definitions and customizable cells'
)]
class DataTableStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $fields = 'Array of field definitions (name, label)';

    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of data items to display';

    #[Prop(type: 'boolean', default: 'false')]
    public string $hideHeader = 'Hide the table header row';

    #[Prop(type: 'boolean', default: 'false')]
    public string $hideFooter = 'Hide the table footer row';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $thead_field = 'Custom header cell content for specific field';

    #[Slot]
    public string $tbody_field = 'Custom body cell content for specific field (has access to item variable)';

    #[Story('Basic Data Table', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set users = [
            { name: 'John Doe', email: 'john@example.com', role: 'Admin' },
            { name: 'Jane Smith', email: 'jane@example.com', role: 'Editor' },
            { name: 'Bob Wilson', email: 'bob@example.com', role: 'User' },
        ] %}
        <twig:ui:data-table
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'email', label: 'Email' },
                { name: 'role', label: 'Role' }
            ]"
            :items="users"
        />
        TWIG);
    }

    #[Story('Simple Field Names', order: 1)]
    public function simpleFieldNames(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set products = [
            { product: 'Widget A', price: '$29.99', stock: '150' },
            { product: 'Widget B', price: '$49.99', stock: '75' },
            { product: 'Widget C', price: '$19.99', stock: '200' },
        ] %}
        <twig:ui:data-table
            :fields="['product', 'price', 'stock']"
            :items="products"
        />
        TWIG);
    }

    #[Story('With Custom Cell Content', order: 2)]
    public function customCellContent(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set users = [
            { name: 'John Doe', status: 'active', role: 'Admin' },
            { name: 'Jane Smith', status: 'inactive', role: 'Editor' },
            { name: 'Bob Wilson', status: 'active', role: 'User' },
        ] %}
        <twig:ui:data-table
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'status', label: 'Status' },
                { name: 'role', label: 'Role' }
            ]"
            :items="users"
        >
            <twig:block name="tbody_status">
                <twig:ui:badge :variant="item.status == 'active' ? 'success' : 'secondary'">
                    {{ item.status }}
                </twig:ui:badge>
            </twig:block>
        </twig:ui:data-table>
        TWIG);
    }

    #[Story('Empty State', order: 3)]
    public function empty(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:data-table
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'email', label: 'Email' }
            ]"
            :items="[]"
        />
        TWIG);
    }
}
