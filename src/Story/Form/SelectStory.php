<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'select',
    category: 'form',
    label: 'Select',
    description: 'Native select dropdown with styled options'
)]
class SelectStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name for submission';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Select element ID';

    #[Prop(type: 'string | null', default: 'null')]
    public string $value = 'Selected value';

    #[Prop(type: 'string', default: "'Sélectionnez une option'")]
    public string $placeholder = 'Placeholder text for empty state';

    #[Prop(type: 'array', default: '[]')]
    public string $options = 'Array of options: [{value, label, disabled?}] or simple values';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Select size';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Whether field is required';

    #[Prop(type: 'boolean', default: 'false')]
    public string $autofocus = 'Autofocus on page load';

    #[Prop(type: 'string | null', default: 'null')]
    public string $autocomplete = 'Autocomplete attribute';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the select';

    #[Prop(type: 'boolean', default: 'false')]
    public string $invalid = 'Mark as invalid';

    #[Prop(type: 'FormView | null', default: 'null')]
    public string $form = 'Symfony form field for auto-configuration';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Custom options (alternative to options prop)';

    #[Story('Basic Select (options prop)', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="country"
                :options="[
                    { value: 'us', label: 'United States' },
                    { value: 'ca', label: 'Canada' },
                    { value: 'mx', label: 'Mexico' },
                    { value: 'uk', label: 'United Kingdom' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('With Block Content', order: 1)]
    public function blockContent(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select name="fruit">
                <option value="">Select a fruit</option>
                <option value="apple">Apple</option>
                <option value="banana">Banana</option>
                <option value="cherry">Cherry</option>
            </twig:ui:select>
        </div>
        TWIG);
    }

    #[Story('Size Options', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <p class="text-xs text-gray-500 mb-1">Small (sm)</p>
                <twig:ui:select
                    name="size_sm"
                    size="sm"
                    :options="[
                        { value: '1', label: 'Option 1' },
                        { value: '2', label: 'Option 2' },
                        { value: '3', label: 'Option 3' }
                    ]"
                />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-1">Medium (md) - default</p>
                <twig:ui:select
                    name="size_md"
                    size="md"
                    :options="[
                        { value: '1', label: 'Option 1' },
                        { value: '2', label: 'Option 2' },
                        { value: '3', label: 'Option 3' }
                    ]"
                />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-1">Large (lg)</p>
                <twig:ui:select
                    name="size_lg"
                    size="lg"
                    :options="[
                        { value: '1', label: 'Option 1' },
                        { value: '2', label: 'Option 2' },
                        { value: '3', label: 'Option 3' }
                    ]"
                />
            </div>
        </div>
        TWIG);
    }

    #[Story('Custom Placeholder', order: 3)]
    public function customPlaceholder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="priority"
                placeholder="Choose priority level..."
                :options="[
                    { value: 'low', label: 'Low Priority' },
                    { value: 'medium', label: 'Medium Priority' },
                    { value: 'high', label: 'High Priority' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('With Pre-selected Value', order: 4)]
    public function preselected(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="status"
                value="active"
                :options="[
                    { value: 'draft', label: 'Draft' },
                    { value: 'active', label: 'Active' },
                    { value: 'archived', label: 'Archived' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Required', order: 5)]
    public function required(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="required"
                required
                :options="[
                    { value: '1', label: 'Option 1' },
                    { value: '2', label: 'Option 2' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="disabled"
                disabled
                value="locked"
                :options="[
                    { value: 'locked', label: 'Cannot change this value' }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('With Disabled Options', order: 7)]
    public function disabledOptions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="plan"
                :options="[
                    { value: 'free', label: 'Free Plan' },
                    { value: 'pro', label: 'Pro Plan' },
                    { value: 'enterprise', label: 'Enterprise (Coming Soon)', disabled: true }
                ]"
            />
        </div>
        TWIG);
    }

    #[Story('With Option Groups', order: 8)]
    public function optionGroups(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select name="groups">
                <option value="">Select a fruit</option>
                <optgroup label="Citrus">
                    <option value="orange">Orange</option>
                    <option value="lemon">Lemon</option>
                    <option value="grapefruit">Grapefruit</option>
                </optgroup>
                <optgroup label="Berries">
                    <option value="strawberry">Strawberry</option>
                    <option value="blueberry">Blueberry</option>
                    <option value="raspberry">Raspberry</option>
                </optgroup>
                <optgroup label="Tropical">
                    <option value="mango">Mango</option>
                    <option value="pineapple">Pineapple</option>
                </optgroup>
            </twig:ui:select>
        </div>
        TWIG);
    }

    #[Story('Simple Values Array', order: 9)]
    public function simpleValues(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:select
                name="simple"
                placeholder="Select a color"
                :options="['Red', 'Green', 'Blue', 'Yellow']"
            />
        </div>
        TWIG);
    }
}
