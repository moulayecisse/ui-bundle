<?php

namespace Cisse\Bundle\Ui\Story\Type;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'badge-type',
    category: 'type',
    label: 'Badge Type',
    description: 'Auto-mapped status badges with intelligent color mapping'
)]
class BadgeTypeStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $value = 'Value to display (also used for auto color mapping)';

    #[Prop(type: "'xs' | 'sm' | 'md' | 'lg'", default: "'sm'")]
    public string $size = 'Badge size';

    #[Prop(type: 'object | null', default: 'null')]
    public string $mapping = 'Custom value-to-color mapping (overrides defaults)';

    #[Prop(type: 'string', default: "'-'")]
    public string $fallback = 'Fallback text when value is null';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Auto-Mapped Status Badges', order: 0)]
    public function autoMapped(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:type:badge value="active" />
            <twig:ui:type:badge value="pending" />
            <twig:ui:type:badge value="inactive" />
            <twig:ui:type:badge value="error" />
            <twig:ui:type:badge value="info" />
            <twig:ui:type:badge value="new" />
        </div>
        TWIG);
    }

    #[Story('Default Color Mapping', order: 1)]
    public function colorMapping(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
            <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Default Color Mapping</h4>
            <div class="text-sm text-blue-800 dark:text-blue-200 space-y-1">
                <p><strong class="text-green-600 dark:text-green-400">Success (green):</strong> active, enabled, completed, success, yes, true</p>
                <p><strong class="text-yellow-600 dark:text-yellow-400">Warning (yellow):</strong> pending, warning</p>
                <p><strong class="text-red-600 dark:text-red-400">Error (red):</strong> error, failed, no, false</p>
                <p><strong class="text-blue-600 dark:text-blue-400">Info (blue):</strong> info, new</p>
                <p><strong class="text-gray-600 dark:text-gray-400">Gray:</strong> inactive, disabled, or any unmapped value</p>
            </div>
        </div>
        TWIG);
    }

    #[Story('Boolean-like Values', order: 2)]
    public function booleanLike(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:type:badge value="yes" />
            <twig:ui:type:badge value="no" />
            <twig:ui:type:badge value="true" />
            <twig:ui:type:badge value="false" />
            <twig:ui:type:badge value="enabled" />
            <twig:ui:type:badge value="disabled" />
        </div>
        TWIG);
    }

    #[Story('Process Status', order: 3)]
    public function processStatus(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:type:badge value="completed" />
            <twig:ui:type:badge value="success" />
            <twig:ui:type:badge value="failed" />
            <twig:ui:type:badge value="warning" />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-3">
            <twig:ui:type:badge value="active" size="xs" />
            <twig:ui:type:badge value="active" size="sm" />
            <twig:ui:type:badge value="active" size="md" />
            <twig:ui:type:badge value="active" size="lg" />
        </div>
        TWIG);
    }

    #[Story('Custom Values (Unmapped)', order: 5)]
    public function customValues(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:type:badge value="draft" />
            <twig:ui:type:badge value="published" />
            <twig:ui:type:badge value="archived" />
        </div>
        TWIG);
    }

    #[Story('With Custom Mapping', order: 6)]
    public function customMapping(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            {% set customMapping = {
                'draft': 'warning',
                'published': 'success',
                'archived': 'gray'
            } %}
            <twig:ui:type:badge value="draft" :mapping="customMapping" />
            <twig:ui:type:badge value="published" :mapping="customMapping" />
            <twig:ui:type:badge value="archived" :mapping="customMapping" />
        </div>
        TWIG);
    }

    #[Story('Null Value with Fallback', order: 7)]
    public function fallbackValue(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:type:badge :value="null" />
            <twig:ui:type:badge :value="null" fallback="N/A" />
            <twig:ui:type:badge :value="null" fallback="Unknown" />
        </div>
        TWIG);
    }

    #[Story('In Table Context', order: 8)]
    public function inTable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">John Doe</td>
                    <td class="px-4 py-2"><twig:ui:type:badge value="active" /></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">Jane Smith</td>
                    <td class="px-4 py-2"><twig:ui:type:badge value="pending" /></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">Bob Wilson</td>
                    <td class="px-4 py-2"><twig:ui:type:badge value="inactive" /></td>
                </tr>
            </tbody>
        </table>
        TWIG);
    }
}
