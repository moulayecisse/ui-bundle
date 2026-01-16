<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'search',
    category: 'form',
    label: 'Search Form',
    description: 'Complete search form with input and optional submit button'
)]
class SearchStory extends AbstractComponentStory
{
    #[Prop(type: 'FormView | null', default: 'null')]
    public string $form = 'Symfony form object';

    #[Prop(type: 'string | null', default: 'null')]
    public string $action = 'Form action URL';

    #[Prop(type: 'string | null', default: 'null')]
    public string $method = 'Form method (GET, POST)';

    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form name attribute';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Search input size';

    #[Prop(type: "'default' | 'filled' | 'flushed'", default: "'default'")]
    public string $variant = 'Input style variant';

    #[Prop(type: "'none' | 'sm' | 'md' | 'lg' | 'xl' | 'full'", default: "'lg'")]
    public string $rounded = 'Border radius';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[NestedAttribute]
    public string $wrapper = 'Attributes passed to the input-wrapper element';

    #[NestedAttribute]
    public string $icon = 'Icon attributes (icon:name, icon:class)';

    #[NestedAttribute]
    public string $input = 'Input attributes (input:name, input:value, input:placeholder)';

    #[NestedAttribute]
    public string $submit = 'Submit button attributes (submit:show, submit:label, submit:icon)';

    #[NestedAttribute]
    public string $divider = 'Divider attributes (divider:hide)';

    #[NestedAttribute]
    public string $token = 'CSRF token attributes (token:name, token:value)';

    #[Story('Default', order: 0)]
    public function default(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search action="/search" method="GET" input:name="q" input:placeholder="Search..." />
        </div>
        TWIG);
    }

    #[Story('With Submit Button', order: 1)]
    public function withSubmit(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search
                action="/search"
                method="GET"
                input:name="q"
                input:placeholder="Search products..."
                submit:show
            />
        </div>
        TWIG);
    }

    #[Story('With Submit Icon', order: 2)]
    public function withSubmitIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search
                action="/search"
                method="GET"
                input:name="q"
                input:placeholder="Search..."
                submit:show
                submit:label="Go"
                submit:icon="heroicons:arrow-right"
            />
        </div>
        TWIG);
    }

    #[Story('Without Divider', order: 3)]
    public function withoutDivider(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search
                action="/search"
                input:name="q"
                input:placeholder="Search..."
                submit:show
                divider:hide
            />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Small</span>
                <twig:ui:form:search action="#" input:name="q" size="sm" submit:show input:placeholder="Small search" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:form:search action="#" input:name="q" size="md" submit:show input:placeholder="Medium search" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:form:search action="#" input:name="q" size="lg" submit:show input:placeholder="Large search" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Variants', order: 5)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Default</span>
                <twig:ui:form:search action="#" input:name="q" variant="default" submit:show input:placeholder="Default variant" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Filled</span>
                <twig:ui:form:search action="#" input:name="q" variant="filled" submit:show input:placeholder="Filled variant" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Custom Icon', order: 6)]
    public function customIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search
                action="/filter"
                input:name="filter"
                icon:name="heroicons:funnel"
                input:placeholder="Filter results..."
                submit:show
                submit:label="Apply"
            />
        </div>
        TWIG);
    }

    #[Story('Full Customization', order: 7)]
    public function fullCustomization(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:form:search
                action="/search"
                input:name="q"
                size="lg"
                variant="filled"
                rounded="full"
                submit:show
                submit:label="Find"
                submit:icon="heroicons:magnifying-glass"
                submit:class="bg-primary text-white rounded-full hover:bg-primary/90"
            />
        </div>
        TWIG);
    }

    #[Story('With Pre-filled Value', order: 8)]
    public function preFilled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search action="/search" input:name="q" input:value="existing query" submit:show input:placeholder="Search..." />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 9)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:search action="/search" input:name="q" submit:show disabled input:placeholder="Disabled..." />
        </div>
        TWIG);
    }
}
