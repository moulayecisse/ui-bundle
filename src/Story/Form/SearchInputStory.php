<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'search-input',
    category: 'form',
    label: 'Search Input',
    description: 'Standalone search input with icon'
)]
class SearchInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $value = 'Input value.';

    #[Prop(type: 'string', default: "'heroicons:magnifying-glass'")]
    public string $icon = 'Icon name for the search icon.';

    #[Prop(type: 'string', default: "'Search...'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: "'default'|'filled'|'flushed'|'unstyled'", default: "'default'")]
    public string $variant = 'Input style variant.';

    #[Prop(type: "'none'|'sm'|'md'|'lg'|'xl'|'full'", default: "'lg'")]
    public string $rounded = 'Border radius.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $autofocus = 'Autofocus on load.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $autocomplete = 'Autocomplete attribute.';

    #[Prop(type: 'FormView|null', default: 'null')]
    public string $form = 'Symfony form field.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[NestedAttribute]
    public string $wrapper = 'Attributes passed to the input-wrapper element.';

    #[NestedAttribute]
    public string $iconAttr = 'Attributes passed to the search icon (icon:name, icon:class).';

    #[NestedAttribute]
    public string $input = 'Attributes passed to the input element.';

    #[Story('Default', order: 0)]
    public function default(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:search />
        </div>
        TWIG);
    }

    #[Story('With Placeholder', order: 1)]
    public function withPlaceholder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:search placeholder="Search products..." />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Small</span>
                <twig:ui:input:search size="sm" placeholder="Small search" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:input:search size="md" placeholder="Medium search" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:input:search size="lg" placeholder="Large search" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Variants', order: 3)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Default</span>
                <twig:ui:input:search variant="default" placeholder="Default variant" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Filled</span>
                <twig:ui:input:search variant="filled" placeholder="Filled variant" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Flushed</span>
                <twig:ui:input:search variant="flushed" placeholder="Flushed variant" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Rounded', order: 4)]
    public function rounded(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">None</span>
                <twig:ui:input:search rounded="none" placeholder="No rounding" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium</span>
                <twig:ui:input:search rounded="md" placeholder="Medium rounding" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Full</span>
                <twig:ui:input:search rounded="full" placeholder="Full rounding" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Custom Icon', order: 5)]
    public function customIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Default icon</span>
                <twig:ui:input:search placeholder="Search..." />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Custom icon (via prop)</span>
                <twig:ui:input:search icon="heroicons:funnel" placeholder="Filter..." />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Custom icon (via nested attribute)</span>
                <twig:ui:input:search icon:name="heroicons:adjustments-horizontal" placeholder="Settings..." />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 6)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:label for="search-label">Search</twig:ui:label>
            <twig:ui:input:search name="search-label" id="search-label" placeholder="Search articles..." />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 7)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:search value="Disabled search" disabled />
        </div>
        TWIG);
    }
}
