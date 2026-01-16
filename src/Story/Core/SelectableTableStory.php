<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'selectable-table',
    category: 'core',
    label: 'Selectable Table',
    description: 'Table with row selection, batch actions, and expandable rows'
)]
class SelectableTableStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $fields = 'Array of field definitions ({ name, label })';

    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of items to display';

    #[Prop(type: 'string', default: "'id'")]
    public string $identifier = 'Field to use as unique identifier';

    #[Prop(type: 'boolean', default: 'false')]
    public string $selectable = 'Enable row selection with checkboxes';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showActions = 'Show actions column';

    #[Prop(type: 'boolean', default: 'false')]
    public string $expandable = 'Enable expandable rows';

    #[Prop(type: 'string', default: "'Aucun résultat trouvé'")]
    public string $emptyLabel = 'Text when no items';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $thead = 'Custom table header content';

    #[Slot]
    public string $tbody = 'Custom table body content';

    #[Slot]
    public string $tfoot = 'Table footer content';

    #[Slot]
    public string $batch_actions = 'Batch action buttons when rows selected';

    #[Slot]
    public string $tbody_actions = 'Action buttons for each row';

    #[Slot]
    public string $expanded = 'Content for expanded rows';

    #[Slot]
    public string $empty = 'Custom empty state content';

    #[Story('Basic Selectable Table', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set users = [
            { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin' },
            { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'Editor' },
            { id: 3, name: 'Bob Wilson', email: 'bob@example.com', role: 'User' },
        ] %}
        <twig:ui:table:selectable
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'email', label: 'Email' },
                { name: 'role', label: 'Role' }
            ]"
            :items="users"
            :selectable="true"
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
            { id: 3, product: 'Widget C', price: '$19.99', stock: '200' },
        ] %}
        <twig:ui:table:selectable
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
                <twig:ui:button size="sm" variant="ghost" color="danger">Delete</twig:ui:button>
            </twig:block>
        </twig:ui:table:selectable>
        TWIG);
    }

    #[Story('With Batch Actions', order: 2)]
    public function withBatchActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set items = [
            { id: 1, name: 'Document A', type: 'PDF', size: '2.5 MB' },
            { id: 2, name: 'Document B', type: 'DOC', size: '1.2 MB' },
            { id: 3, name: 'Document C', type: 'XLS', size: '3.8 MB' },
        ] %}
        <twig:ui:table:selectable
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'type', label: 'Type' },
                { name: 'size', label: 'Size' }
            ]"
            :items="items"
            :selectable="true"
        >
            <twig:block name="batch_actions">
                <twig:ui:button size="sm" variant="outline">Download</twig:ui:button>
                <twig:ui:button size="sm" variant="outline" color="danger">Delete</twig:ui:button>
            </twig:block>
        </twig:ui:table:selectable>
        TWIG);
    }

    #[Story('Empty State', order: 3)]
    public function empty(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table:selectable
            :fields="[
                { name: 'name', label: 'Name' },
                { name: 'email', label: 'Email' }
            ]"
            :items="[]"
            emptyLabel="No users found"
        />
        TWIG);
    }
}
