<?php

namespace Cisse\Bundle\Ui\Story\Type;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'boolean',
    category: 'type',
    label: 'Boolean',
    description: 'Display boolean values with icon, text, or badge variants'
)]
class BooleanStory extends AbstractComponentStory
{
    #[Prop(type: 'boolean', default: 'false')]
    public string $value = 'The boolean value to display';

    #[Prop(type: "'xs' | 'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Display size';

    #[Prop(type: "'icon' | 'text' | 'badge'", default: "'icon'")]
    public string $variant = 'Display style';

    #[Prop(type: 'string', default: "'heroicons:check-16-solid'")]
    public string $trueIcon = 'Icon for true value (icon variant)';

    #[Prop(type: 'string', default: "'heroicons:x-mark-16-solid'")]
    public string $falseIcon = 'Icon for false value (icon variant)';

    #[Prop(type: 'string', default: "'text-green-600'")]
    public string $trueColor = 'Color class for true value';

    #[Prop(type: 'string', default: "'text-red-600'")]
    public string $falseColor = 'Color class for false value';

    #[Prop(type: 'string', default: "'Yes'")]
    public string $trueLabel = 'Label for true value (text/badge variants)';

    #[Prop(type: 'string', default: "'No'")]
    public string $falseLabel = 'Label for false value (text/badge variants)';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Boolean', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">True:</span>
                <twig:ui:boolean :value="true" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">False:</span>
                <twig:ui:boolean :value="false" />
            </div>
        </div>
        TWIG);
    }

    #[Story('In Table Context', order: 1)]
    public function inTable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="text-left py-2 px-4 font-medium text-gray-700 dark:text-gray-300">User</th>
                        <th class="text-left py-2 px-4 font-medium text-gray-700 dark:text-gray-300">Active</th>
                        <th class="text-left py-2 px-4 font-medium text-gray-700 dark:text-gray-300">Verified</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-900 dark:text-white">John Doe</td>
                        <td class="py-2 px-4"><twig:ui:boolean :value="true" /></td>
                        <td class="py-2 px-4"><twig:ui:boolean :value="true" /></td>
                    </tr>
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-900 dark:text-white">Jane Smith</td>
                        <td class="py-2 px-4"><twig:ui:boolean :value="true" /></td>
                        <td class="py-2 px-4"><twig:ui:boolean :value="false" /></td>
                    </tr>
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4 text-gray-900 dark:text-white">Bob Wilson</td>
                        <td class="py-2 px-4"><twig:ui:boolean :value="false" /></td>
                        <td class="py-2 px-4"><twig:ui:boolean :value="false" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        TWIG);
    }

    #[Story('Various Value Types', order: 2)]
    public function valueTypes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400 w-32">String "1":</span>
                <twig:ui:boolean value="1" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400 w-32">String "0":</span>
                <twig:ui:boolean value="0" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400 w-32">Boolean true:</span>
                <twig:ui:boolean :value="true" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400 w-32">Boolean false:</span>
                <twig:ui:boolean :value="false" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500">XS:</span>
                <twig:ui:boolean :value="true" size="xs" />
                <twig:ui:boolean :value="false" size="xs" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500">SM:</span>
                <twig:ui:boolean :value="true" size="sm" />
                <twig:ui:boolean :value="false" size="sm" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500">MD:</span>
                <twig:ui:boolean :value="true" size="md" />
                <twig:ui:boolean :value="false" size="md" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500">LG:</span>
                <twig:ui:boolean :value="true" size="lg" />
                <twig:ui:boolean :value="false" size="lg" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Display Variants', order: 4)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-20">Icon:</span>
                <twig:ui:boolean :value="true" variant="icon" />
                <twig:ui:boolean :value="false" variant="icon" />
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-20">Text:</span>
                <twig:ui:boolean :value="true" variant="text" />
                <twig:ui:boolean :value="false" variant="text" />
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-20">Badge:</span>
                <twig:ui:boolean :value="true" variant="badge" />
                <twig:ui:boolean :value="false" variant="badge" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Custom Labels', order: 5)]
    public function customLabels(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-32">Active/Inactive:</span>
                <twig:ui:boolean :value="true" variant="text" trueLabel="Active" falseLabel="Inactive" />
                <twig:ui:boolean :value="false" variant="text" trueLabel="Active" falseLabel="Inactive" />
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-32">Enabled/Disabled:</span>
                <twig:ui:boolean :value="true" variant="badge" trueLabel="Enabled" falseLabel="Disabled" />
                <twig:ui:boolean :value="false" variant="badge" trueLabel="Enabled" falseLabel="Disabled" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Custom Icons & Colors', order: 6)]
    public function customIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Published:</span>
                <twig:ui:boolean :value="true" trueIcon="heroicons:eye-16-solid" falseIcon="heroicons:eye-slash-16-solid" trueColor="text-blue-600" falseColor="text-gray-400" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Locked:</span>
                <twig:ui:boolean :value="true" trueIcon="heroicons:lock-closed-16-solid" falseIcon="heroicons:lock-open-16-solid" trueColor="text-amber-600" falseColor="text-gray-400" />
            </div>
        </div>
        TWIG);
    }
}
