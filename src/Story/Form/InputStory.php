<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'input',
    category: 'form',
    label: 'Input',
    description: 'Base text input with multiple variants and styles'
)]
class InputStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $type = 'Input type (text, email, password, number, date, etc.)';

    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name for submission';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Input element ID';

    #[Prop(type: 'string | null', default: 'null')]
    public string $value = 'Input value';

    #[Prop(type: 'string | null', default: 'null')]
    public string $placeholder = 'Placeholder text';

    #[Prop(type: 'boolean | null', default: 'null')]
    public string $required = 'Whether field is required';

    #[Prop(type: 'boolean', default: 'false')]
    public string $autofocus = 'Autofocus on page load';

    #[Prop(type: 'string | null', default: 'null')]
    public string $autocomplete = 'Autocomplete attribute value';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Input size (affects height and text)';

    #[Prop(type: "'default' | 'filled' | 'flushed' | 'unstyled'", default: "'default'")]
    public string $variant = 'Input visual style';

    #[Prop(type: "'none' | 'sm' | 'md' | 'lg' | 'xl' | 'full'", default: "'lg'")]
    public string $rounded = 'Border radius';

    #[Prop(type: 'FormView | null', default: 'null')]
    public string $form = 'Symfony form field for auto-configuration';

    #[Prop(type: 'array | null', default: 'null')]
    public string $options = 'Options for choice/select type';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input name="basic" label="Basic Input" placeholder="Enter text..." />
        </div>
        TWIG);
    }

    #[Story('With Helper Text', order: 1)]
    public function withHelper(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input name="helper" label="With Helper Text" helper="This is some helpful text." />
        </div>
        TWIG);
    }

    #[Story('Required', order: 2)]
    public function required(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input name="required" label="Required Field" required />
        </div>
        TWIG);
    }

    #[Story('With Icon', order: 3)]
    public function withIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input name="icon" label="With Icon" icon="lucide:search" placeholder="Search..." />
        </div>
        TWIG);
    }

    #[Story('With Error', order: 4)]
    public function withError(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input name="error" label="With Error" error="This field has an error." value="Invalid value" />
        </div>
        TWIG);
    }

    #[Story('Input Types', order: 5)]
    public function inputTypes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input name="text" type="text" label="Text" placeholder="Text input" />
            <twig:ui:input name="number" type="number" label="Number" placeholder="0" />
            <twig:ui:input name="date" type="date" label="Date" />
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 6)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input name="size-sm" size="sm" label="Small" placeholder="Small input" />
            <twig:ui:input name="size-md" size="md" label="Medium (default)" placeholder="Medium input" />
            <twig:ui:input name="size-lg" size="lg" label="Large" placeholder="Large input" />
        </div>
        TWIG);
    }

    #[Story('Style Variants', order: 7)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input name="var-default" variant="default" label="Default" placeholder="Default variant" />
            <twig:ui:input name="var-filled" variant="filled" label="Filled" placeholder="Filled variant" />
            <twig:ui:input name="var-flushed" variant="flushed" label="Flushed" placeholder="Flushed variant" />
            <twig:ui:input name="var-unstyled" variant="unstyled" label="Unstyled" placeholder="Unstyled variant" />
        </div>
        TWIG);
    }

    #[Story('Rounded Variants', order: 8)]
    public function rounded(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:input name="round-none" rounded="none" placeholder="No rounding" />
            <twig:ui:input name="round-sm" rounded="sm" placeholder="Small rounding" />
            <twig:ui:input name="round-lg" rounded="lg" placeholder="Large rounding (default)" />
            <twig:ui:input name="round-full" rounded="full" placeholder="Full rounding" />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 9)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input name="disabled" label="Disabled" value="Cannot edit this" disabled />
        </div>
        TWIG);
    }
}
