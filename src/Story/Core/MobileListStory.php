<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'mobile-list',
    category: 'core',
    label: 'Mobile List',
    description: 'Touch-friendly card-based list for mobile devices'
)]
class MobileListStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of items to display';

    #[Prop(type: 'string', default: "'id'")]
    public string $keyField = 'Field to use as unique key for each item';

    #[Prop(type: 'boolean', default: 'false')]
    public string $selectable = 'Enable row selection with checkboxes';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loading = 'Show loading skeleton';

    #[Prop(type: 'number', default: '5')]
    public string $loadingItems = 'Number of skeleton items when loading';

    #[Prop(type: 'string', default: "'No items found'")]
    public string $emptyLabel = 'Text to show when no items';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Main content area - should contain the loop over items';

    #[Slot]
    public string $empty = 'Custom empty state content';

    #[Slot]
    public string $select_all = 'Custom select all header (when selectable)';

    #[Story('Basic Mobile List', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set users = [
            { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin' },
            { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'Editor' },
            { id: 3, name: 'Bob Wilson', email: 'bob@example.com', role: 'User' },
        ] %}
        <div class="max-w-md">
            <twig:ui:mobile-list :items="users">
                <twig:block name="content">
                    {% for item in users %}
                        <twig:ui:card class="hover:shadow-lg transition-all duration-200">
                            <div class="p-4 flex items-center gap-4">
                                <twig:ui:avatar name="{{ item.name }}" size="md" />
                                <div class="flex-1 min-w-0 overflow-hidden">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ item.name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ item.email }}</div>
                                    <twig:ui:badge size="sm" variant="secondary" class="mt-1">{{ item.role }}</twig:ui:badge>
                                </div>
                                <div class="shrink-0">
                                    <twig:ui:button size="sm" variant="ghost">
                                        <twig:ux:icon name="heroicons:ellipsis-vertical" class="size-4" />
                                    </twig:ui:button>
                                </div>
                            </div>
                        </twig:ui:card>
                    {% endfor %}
                </twig:block>
            </twig:ui:mobile-list>
        </div>
        TWIG);
    }

    #[Story('Selectable', order: 1)]
    public function selectable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        {% set items = [
            { id: 1, name: 'Document A', type: 'PDF', size: '2.5 MB' },
            { id: 2, name: 'Document B', type: 'DOC', size: '1.2 MB' },
            { id: 3, name: 'Document C', type: 'XLS', size: '3.8 MB' },
        ] %}
        <div class="max-w-md">
            <twig:ui:mobile-list :items="items" :selectable="true">
                <twig:block name="content">
                    {% for item in items %}
                        <twig:ui:card
                            data-cisse--ui-bundle--mobile-list-target="item"
                            data-item-id="{{ item.id }}"
                            class="hover:shadow-lg transition-all duration-200"
                        >
                            <div class="p-4 flex items-center gap-4">
                                <div class="shrink-0">
                                    <twig:ui:input:checkbox
                                        data-cisse--ui-bundle--mobile-list-target="itemCheckbox"
                                        data-action="change->cisse--ui-bundle--mobile-list#selectItem"
                                        value="{{ item.id }}"
                                    />
                                </div>
                                <div class="flex-1 min-w-0 overflow-hidden">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ item.name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ item.type }} - {{ item.size }}</div>
                                </div>
                            </div>
                        </twig:ui:card>
                    {% endfor %}
                </twig:block>
            </twig:ui:mobile-list>
        </div>
        TWIG);
    }

    #[Story('Loading State', order: 2)]
    public function loading(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:mobile-list :items="[]" :loading="true" :loadingItems="3" />
        </div>
        TWIG);
    }

    #[Story('Empty State', order: 3)]
    public function empty(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:mobile-list :items="[]" emptyLabel="No users found" />
        </div>
        TWIG);
    }
}
