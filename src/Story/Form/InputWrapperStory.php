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
    name: 'input-wrapper',
    category: 'form',
    label: 'Input Wrapper',
    description: 'Base wrapper component for styled input containers'
)]
class InputWrapperStory extends AbstractComponentStory
{
    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: "'default'|'filled'|'flushed'|'unstyled'", default: "'default'")]
    public string $variant = 'Visual variant.';

    #[Prop(type: "'none'|'sm'|'md'|'lg'|'xl'|'full'", default: "'lg'")]
    public string $rounded = 'Border radius.';

    #[Prop(type: 'boolean', default: 'null')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $invalid = 'Invalid/error state.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[NestedAttribute]
    public string $before = 'Attributes for before slot (before:class, before:divide).';

    #[NestedAttribute]
    public string $after = 'Attributes for after slot (after:class, after:divide).';

    #[NestedAttribute]
    public string $content = 'Attributes passed to the content wrapper.';

    #[Slot]
    public string $beforeSlot = 'Content before the main content (icons, labels).';

    #[Slot]
    public string $contentSlot = 'Main content area.';

    #[Slot]
    public string $afterSlot = 'Content after the main content (icons, buttons).';

    #[Story('Icon Before', order: 0)]
    public function iconBefore(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper>
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Search..." class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Icon After', order: 1)]
    public function iconAfter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper>
                <twig:block name="content">
                    <input type="text" placeholder="Enter email..." class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
                <twig:block name="after">
                    <twig:ux:icon name="heroicons:envelope" class="size-5 text-slate-400" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('With Divider (before:divide)', order: 2)]
    public function dividerBefore(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper :before:divide="true">
                <twig:block name="before">
                    <span class="text-slate-500 text-sm">+1</span>
                </twig:block>
                <twig:block name="content">
                    <input type="tel" placeholder="Phone number" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('With Divider (after:divide)', order: 3)]
    public function dividerAfter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper :after:divide="true">
                <twig:block name="content">
                    <input type="text" value="ABC-123-XYZ" readonly class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
                <twig:block name="after">
                    <button type="button" class="text-slate-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <twig:ux:icon name="heroicons:clipboard" class="size-5" />
                    </button>
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Both Dividers', order: 4)]
    public function bothDividers(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper :before:divide="true" :after:divide="true">
                <twig:block name="before">
                    <span class="text-slate-500 font-medium">$</span>
                </twig:block>
                <twig:block name="content">
                    <input type="number" placeholder="0.00" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
                <twig:block name="after">
                    <span class="text-slate-400 text-sm">USD</span>
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Colored Before (Text Prefix)', order: 5)]
    public function coloredBefore(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper before:class="bg-slate-100 dark:bg-slate-800 border-r border-slate-300 dark:border-slate-700 rounded-l-lg -ml-px px-3">
                <twig:block name="before">
                    <span class="text-slate-500 text-sm">https://</span>
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="example.com" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Colored After (Text Suffix)', order: 6)]
    public function coloredAfter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper after:class="bg-slate-100 dark:bg-slate-800 border-l border-slate-300 dark:border-slate-700 rounded-r-lg -mr-px px-3">
                <twig:block name="content">
                    <input type="number" placeholder="0.00" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
                <twig:block name="after">
                    <span class="text-slate-500 text-sm">EUR</span>
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Different Sizes', order: 7)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input-wrapper size="sm">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-4 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Small" class="block w-full bg-transparent px-2.5 py-1 text-xs focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
            <twig:ui:input-wrapper size="md">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Medium (default)" class="block w-full bg-transparent px-3 py-1.5 text-sm focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
            <twig:ui:input-wrapper size="lg">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-6 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Large" class="block w-full bg-transparent px-4 py-2 text-base focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Variants', order: 8)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input-wrapper variant="default">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Default variant" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
            <twig:ui:input-wrapper variant="filled">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Filled variant" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
            <twig:ui:input-wrapper variant="flushed">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:magnifying-glass" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" placeholder="Flushed variant" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Invalid State', order: 9)]
    public function invalid(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper :invalid="true">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:envelope" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="email" value="invalid-email" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
                <twig:block name="after">
                    <twig:ux:icon name="heroicons:exclamation-circle" class="size-5 text-red-500" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('Disabled State', order: 10)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-wrapper :disabled="true">
                <twig:block name="before">
                    <twig:ux:icon name="heroicons:lock-closed" class="size-5 text-slate-400" />
                </twig:block>
                <twig:block name="content">
                    <input type="text" value="Disabled input" disabled class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                </twig:block>
            </twig:ui:input-wrapper>
        </div>
        TWIG);
    }

    #[Story('All States Comparison', order: 11)]
    public function allStates(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <p class="text-sm text-slate-500 mb-2">Normal State</p>
                <twig:ui:input-wrapper>
                    <twig:block name="content">
                        <input type="text" placeholder="Normal input" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                    </twig:block>
                </twig:ui:input-wrapper>
            </div>
            <div>
                <p class="text-sm text-slate-500 mb-2">Disabled State (gray background)</p>
                <twig:ui:input-wrapper :disabled="true">
                    <twig:block name="content">
                        <input type="text" value="Cannot edit this" disabled class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                    </twig:block>
                </twig:ui:input-wrapper>
            </div>
            <div>
                <p class="text-sm text-slate-500 mb-2">Invalid State (red border)</p>
                <twig:ui:input-wrapper :invalid="true">
                    <twig:block name="content">
                        <input type="text" value="Invalid value" class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                    </twig:block>
                </twig:ui:input-wrapper>
            </div>
            <div>
                <p class="text-sm text-slate-500 mb-2">Disabled + Invalid</p>
                <twig:ui:input-wrapper :disabled="true" :invalid="true">
                    <twig:block name="content">
                        <input type="text" value="Disabled with error" disabled class="block w-full bg-transparent px-3 py-1.5 focus:outline-none" />
                    </twig:block>
                </twig:ui:input-wrapper>
            </div>
        </div>
        TWIG);
    }
}
