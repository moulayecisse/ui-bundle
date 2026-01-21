<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'input-addon',
    category: 'form',
    label: 'Input Addon',
    description: 'Input wrapper with before/after addon slots'
)]
class InputAddonStory extends AbstractComponentStory
{
    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: "'default'|'filled'|'flushed'", default: "'default'")]
    public string $variant = 'Visual variant.';

    #[Prop(type: "'none'|'sm'|'md'|'lg'|'xl'|'full'", default: "'lg'")]
    public string $rounded = 'Border radius.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $divide = 'Show dividers between addons.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[NestedAttribute]
    public string $wrapper = 'Attributes passed to the outer container.';

    #[NestedAttribute]
    public string $before = 'Attributes passed to the before slot wrapper.';

    #[NestedAttribute]
    public string $after = 'Attributes passed to the after slot wrapper.';

    #[Slot]
    public string $beforeSlot = 'Content before the input (icons, labels, buttons).';

    #[Slot]
    public string $content = 'Main content (default: input element).';

    #[Slot]
    public string $afterSlot = 'Content after the input (icons, buttons, text).';

    #[Story('Icon Before', order: 0)]
    public function iconBefore(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="search" placeholder="Search...">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-gray-400" />
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Button After', order: 1)]
    public function buttonAfter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="search" placeholder="Search...">
                <twig:block name="after">
                    <twig:ui:button size="sm">Search</twig:ui:button>
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Text Prefix', order: 2)]
    public function textPrefix(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="domain" placeholder="example.com" before:class="bg-gray-100 dark:bg-gray-800 -ml-px rounded-l-lg border-r border-gray-300 dark:border-gray-700">
                <twig:block name="before">
                    <span class="text-gray-500 text-sm">https://</span>
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Text Suffix', order: 3)]
    public function textSuffix(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="price" placeholder="0.00" type="number" after:class="bg-gray-100 dark:bg-gray-800 -mr-px rounded-r-lg border-l border-gray-300 dark:border-gray-700">
                <twig:block name="after">
                    <span class="text-gray-500 text-sm">EUR</span>
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Copy to Clipboard', order: 4)]
    public function copyToClipboard(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="code" value="ABC-123-XYZ" :readonly="true" :divide="true">
                <twig:block name="after">
                    <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <twig:ux:icon name="heroicons:clipboard" class="size-5" />
                    </button>
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Both Before and After', order: 5)]
    public function bothBeforeAndAfter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="amount" placeholder="0.00" type="number" :divide="true">
                <twig:block name="before">
                    <span class="text-gray-500 font-medium">$</span>
                </twig:block>
                <twig:block name="after">
                    <span class="text-gray-400 text-sm">USD</span>
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('With Dividers', order: 6)]
    public function withDividers(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="phone" placeholder="Phone number" :divide="true">
                <twig:block name="before">
                    <span class="text-gray-500 text-sm">+1</span>
                </twig:block>
                <twig:block name="after">
                    <twig:ux:icon name="heroicons:phone" class="size-5 text-gray-400" />
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Different Sizes', order: 7)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input-addon name="sm" placeholder="Small" size="sm">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-4 text-gray-400" />
                </twig:block>
            </twig:ui:input-addon>
            <twig:ui:input-addon name="md" placeholder="Medium (default)" size="md">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-gray-400" />
                </twig:block>
            </twig:ui:input-addon>
            <twig:ui:input-addon name="lg" placeholder="Large" size="lg">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-6 text-gray-400" />
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }

    #[Story('Filled Variant', order: 8)]
    public function filledVariant(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-addon name="search" placeholder="Search..." variant="filled">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-gray-400" />
                </twig:block>
            </twig:ui:input-addon>
        </div>
        TWIG);
    }
}
