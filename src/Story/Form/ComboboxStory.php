<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'combobox',
    category: 'form',
    label: 'Combobox',
    description: 'Searchable dropdown with autocomplete'
)]
class ComboboxStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $value = 'Selected value.';

    #[Prop(type: 'string', default: "'Select...'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: 'array', default: '[]')]
    public string $options = 'Array of options: [{value, label}].';

    #[Prop(type: 'boolean', default: 'false')]
    public string $multiple = 'Allow multiple selection.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $clearable = 'Show clear button.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Component size.';

    #[Story('Basic Combobox', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:combobox
                name="country"
                placeholder="Select a country"
                :options="[
                    { value: 'us', label: 'United States' },
                    { value: 'uk', label: 'United Kingdom' },
                    { value: 'ca', label: 'Canada' },
                    { value: 'au', label: 'Australia' },
                    { value: 'de', label: 'Germany' },
                    { value: 'fr', label: 'France' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('With Selected Value', order: 1)]
    public function withValue(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:combobox
                name="language"
                value="en"
                :options="[
                    { value: 'en', label: 'English' },
                    { value: 'es', label: 'Spanish' },
                    { value: 'fr', label: 'French' },
                    { value: 'de', label: 'German' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Multiple Selection', order: 2)]
    public function multiple(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:combobox
                name="skills"
                placeholder="Select skills"
                multiple
                :options="[
                    { value: 'js', label: 'JavaScript' },
                    { value: 'ts', label: 'TypeScript' },
                    { value: 'php', label: 'PHP' },
                    { value: 'python', label: 'Python' },
                    { value: 'go', label: 'Go' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Clearable', order: 3)]
    public function clearable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:combobox
                name="status"
                value="active"
                clearable
                :options="[
                    { value: 'active', label: 'Active' },
                    { value: 'pending', label: 'Pending' },
                    { value: 'inactive', label: 'Inactive' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <twig:ui:combobox
                name="size-sm"
                size="sm"
                value="small"
                :options="[{ value: 'small', label: 'Small Size' }]"
            />
            <twig:ui:combobox
                name="size-md"
                size="md"
                value="medium"
                :options="[{ value: 'medium', label: 'Medium Size' }]"
            />
            <twig:ui:combobox
                name="size-lg"
                size="lg"
                value="large"
                :options="[{ value: 'large', label: 'Large Size' }]"
            />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 5)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:combobox
                name="disabled"
                value="option1"
                disabled
                :options="[
                    { value: 'option1', label: 'Option 1' },
                    { value: 'option2', label: 'Option 2' }
                ]"
            />
        </div>
        TWIG);
    }
}
