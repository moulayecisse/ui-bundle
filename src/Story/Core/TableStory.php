<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'table',
    category: 'core',
    label: 'Table',
    description: 'Data table with sorting, striping, and various style options'
)]
class TableStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes for the table element.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $striped = 'Alternate row background colors.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $hover = 'Highlight rows on hover.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $compact = 'Reduce cell padding for compact display.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Table text size.';

    #[Prop(type: "'default'|'card'|'simple'", default: "'default'")]
    public string $variant = 'Visual style variant.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $stickyHeader = 'Make header sticky on scroll.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $responsive = 'Wrap table in overflow container.';

    #[Slot]
    public string $thead = 'Table header rows with header cells.';

    #[Slot]
    public string $tbody = 'Table body rows with data cells.';

    #[Slot]
    public string $tfoot = 'Optional table footer rows.';

    #[Story('Basic Table', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th>Name</twig:ui:th>
                    <twig:ui:th>Email</twig:ui:th>
                    <twig:ui:th>Role</twig:ui:th>
                </twig:ui:tr>
            </twig:block>
            <twig:block name="tbody">
                <twig:ui:tr>
                    <twig:ui:td>John Doe</twig:ui:td>
                    <twig:ui:td>john@example.com</twig:ui:td>
                    <twig:ui:td>Admin</twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr>
                    <twig:ui:td>Jane Smith</twig:ui:td>
                    <twig:ui:td>jane@example.com</twig:ui:td>
                    <twig:ui:td>Editor</twig:ui:td>
                </twig:ui:tr>
            </twig:block>
        </twig:ui:table>
        TWIG);
    }

    #[Story('Striped with Hover', order: 1)]
    public function stripedWithHover(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table striped hover>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th>Name</twig:ui:th>
                    <twig:ui:th>Email</twig:ui:th>
                    <twig:ui:th>Role</twig:ui:th>
                </twig:ui:tr>
            </twig:block>
            <twig:block name="tbody">
                <twig:ui:tr>
                    <twig:ui:td>John Doe</twig:ui:td>
                    <twig:ui:td>john@example.com</twig:ui:td>
                    <twig:ui:td>Admin</twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr>
                    <twig:ui:td>Jane Smith</twig:ui:td>
                    <twig:ui:td>jane@example.com</twig:ui:td>
                    <twig:ui:td>Editor</twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr>
                    <twig:ui:td>Bob Wilson</twig:ui:td>
                    <twig:ui:td>bob@example.com</twig:ui:td>
                    <twig:ui:td>User</twig:ui:td>
                </twig:ui:tr>
            </twig:block>
        </twig:ui:table>
        TWIG);
    }

    #[Story('Sortable Headers', order: 2)]
    public function sortableHeaders(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th sortable sorted="asc">Name</twig:ui:th>
                    <twig:ui:th sortable>Email</twig:ui:th>
                    <twig:ui:th sortable align="right">Amount</twig:ui:th>
                </twig:ui:tr>
            </twig:block>
            <twig:block name="tbody">
                <twig:ui:tr>
                    <twig:ui:td>Alice</twig:ui:td>
                    <twig:ui:td>alice@example.com</twig:ui:td>
                    <twig:ui:td align="right">$120.00</twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr>
                    <twig:ui:td>Bob</twig:ui:td>
                    <twig:ui:td>bob@example.com</twig:ui:td>
                    <twig:ui:td align="right">$85.50</twig:ui:td>
                </twig:ui:tr>
            </twig:block>
        </twig:ui:table>
        TWIG);
    }

    #[Story('Card Variant', order: 3)]
    public function cardVariant(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table variant="card" striped>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th>Product</twig:ui:th>
                    <twig:ui:th align="right">Price</twig:ui:th>
                    <twig:ui:th align="center">Stock</twig:ui:th>
                </twig:ui:tr>
            </twig:block>
            <twig:block name="tbody">
                <twig:ui:tr>
                    <twig:ui:td>Widget A</twig:ui:td>
                    <twig:ui:td align="right">$29.99</twig:ui:td>
                    <twig:ui:td align="center">150</twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr>
                    <twig:ui:td>Widget B</twig:ui:td>
                    <twig:ui:td align="right">$49.99</twig:ui:td>
                    <twig:ui:td align="center">75</twig:ui:td>
                </twig:ui:tr>
            </twig:block>
        </twig:ui:table>
        TWIG);
    }

    #[Story('Row States', order: 4)]
    public function rowStates(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table hover>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th>Item</twig:ui:th>
                    <twig:ui:th>Status</twig:ui:th>
                </twig:ui:tr>
            </twig:block>
            <twig:block name="tbody">
                <twig:ui:tr selected>
                    <twig:ui:td>Selected Row</twig:ui:td>
                    <twig:ui:td><twig:ui:badge color="primary">Selected</twig:ui:badge></twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr>
                    <twig:ui:td>Normal Row</twig:ui:td>
                    <twig:ui:td><twig:ui:badge color="gray">Normal</twig:ui:badge></twig:ui:td>
                </twig:ui:tr>
                <twig:ui:tr disabled>
                    <twig:ui:td>Disabled Row</twig:ui:td>
                    <twig:ui:td><twig:ui:badge color="gray">Disabled</twig:ui:badge></twig:ui:td>
                </twig:ui:tr>
            </twig:block>
        </twig:ui:table>
        TWIG);
    }

    #[Story('Size Variants', order: 5)]
    public function sizeVariants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-8">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-2">Small</p>
                <twig:ui:table size="sm" compact>
                    <twig:block name="thead">
                        <twig:ui:tr>
                            <twig:ui:th>Name</twig:ui:th>
                            <twig:ui:th>Value</twig:ui:th>
                        </twig:ui:tr>
                    </twig:block>
                    <twig:block name="tbody">
                        <twig:ui:tr>
                            <twig:ui:td>Item 1</twig:ui:td>
                            <twig:ui:td>100</twig:ui:td>
                        </twig:ui:tr>
                    </twig:block>
                </twig:ui:table>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-2">Large</p>
                <twig:ui:table size="lg">
                    <twig:block name="thead">
                        <twig:ui:tr>
                            <twig:ui:th>Name</twig:ui:th>
                            <twig:ui:th>Value</twig:ui:th>
                        </twig:ui:tr>
                    </twig:block>
                    <twig:block name="tbody">
                        <twig:ui:tr>
                            <twig:ui:td>Item 1</twig:ui:td>
                            <twig:ui:td>100</twig:ui:td>
                        </twig:ui:tr>
                    </twig:block>
                </twig:ui:table>
            </div>
        </div>
        TWIG);
    }

    #[Story('Expandable Rows', order: 6)]
    public function expandableRows(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th class="w-10"></twig:ui:th>
                    <twig:ui:th>Name</twig:ui:th>
                    <twig:ui:th>Email</twig:ui:th>
                    <twig:ui:th>Status</twig:ui:th>
                </twig:ui:tr>
            </twig:block>

            <twig:ui:tr expandable :colspan="3">
                <twig:ui:td>John Doe</twig:ui:td>
                <twig:ui:td>john@example.com</twig:ui:td>
                <twig:ui:td><twig:ui:badge color="success">Active</twig:ui:badge></twig:ui:td>

                <twig:block name="expanded">
                    <div class="grid grid-cols-2 gap-4">
                        <twig:ui:code-block title="User Details">
                        {
                            "id": 1,
                            "phone": "+1 234 567 890",
                            "address": "123 Main St",
                            "created_at": "2024-01-15"
                        }
                        </twig:ui:code-block>
                        <twig:ui:code-block title="Permissions">
                        {
                            "role": "admin",
                            "permissions": ["read", "write", "delete"]
                        }
                        </twig:ui:code-block>
                    </div>
                </twig:block>
            </twig:ui:tr>

            <twig:ui:tr expandable :colspan="3">
                <twig:ui:td>Jane Smith</twig:ui:td>
                <twig:ui:td>jane@example.com</twig:ui:td>
                <twig:ui:td><twig:ui:badge color="warning">Pending</twig:ui:badge></twig:ui:td>

                <twig:block name="expanded">
                    <div class="grid grid-cols-2 gap-4">
                        <twig:ui:code-block title="User Details">
                        {
                            "id": 2,
                            "phone": "+1 987 654 321",
                            "address": "456 Oak Ave",
                            "created_at": "2024-02-20"
                        }
                        </twig:ui:code-block>
                        <twig:ui:code-block title="Permissions">
                        {
                            "role": "editor",
                            "permissions": ["read", "write"]
                        }
                        </twig:ui:code-block>
                    </div>
                </twig:block>
            </twig:ui:tr>
        </twig:ui:table>
        TWIG);
    }

    #[Story('Expandable with Default Expanded', order: 7)]
    public function expandableDefaultOpen(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:table>
            <twig:block name="thead">
                <twig:ui:tr>
                    <twig:ui:th class="w-10"></twig:ui:th>
                    <twig:ui:th>Order</twig:ui:th>
                    <twig:ui:th>Customer</twig:ui:th>
                    <twig:ui:th align="right">Total</twig:ui:th>
                </twig:ui:tr>
            </twig:block>

            <twig:ui:tr expandable :colspan="3" defaultExpanded>
                <twig:ui:td>#ORD-001</twig:ui:td>
                <twig:ui:td>Alice Johnson</twig:ui:td>
                <twig:ui:td align="right">$125.00</twig:ui:td>

                <twig:block name="expanded">
                    <twig:ui:datalist :items="[
                        { label: 'Product', value: 'Widget Pro' },
                        { label: 'Quantity', value: '5' },
                        { label: 'Unit Price', value: '$25.00' },
                        { label: 'Shipping', value: 'Express' }
                    ]" />
                </twig:block>
            </twig:ui:tr>

            <twig:ui:tr expandable :colspan="3">
                <twig:ui:td>#ORD-002</twig:ui:td>
                <twig:ui:td>Bob Williams</twig:ui:td>
                <twig:ui:td align="right">$89.50</twig:ui:td>

                <twig:block name="expanded">
                    <twig:ui:datalist :items="[
                        { label: 'Product', value: 'Widget Basic' },
                        { label: 'Quantity', value: '3' },
                        { label: 'Unit Price', value: '$29.83' },
                        { label: 'Shipping', value: 'Standard' }
                    ]" />
                </twig:block>
            </twig:ui:tr>
        </twig:ui:table>
        TWIG);
    }
}
