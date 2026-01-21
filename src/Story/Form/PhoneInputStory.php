<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'phone-input',
    category: 'form',
    label: 'Phone Input',
    description: 'International phone input with country selector'
)]
class PhoneInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'phone'")]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Phone number value.';

    #[Prop(type: 'string', default: "'Phone number'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showDialCode = 'Show dial code in input value.';

    #[Prop(type: 'string', default: "'FR'")]
    public string $defaultCountry = 'Default country code (ISO 3166-1 alpha-2).';

    #[Prop(type: 'array|null', default: 'null')]
    public string $countries = 'Custom list of countries.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Phone Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:phone name="phone" placeholder="Enter phone number..." />
        </div>
        TWIG);
    }

    #[Story('With Country Selection', order: 1)]
    public function withCountry(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Click the flag to select a different country. The phone format will adjust automatically.
            </p>
            <twig:ui:input:phone name="phone-country" defaultCountry="US" />
        </div>
        TWIG);
    }

    #[Story('Different Default Countries', order: 2)]
    public function defaultCountries(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">France (default)</span>
                <twig:ui:input:phone name="phone-fr" defaultCountry="FR" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">United States</span>
                <twig:ui:input:phone name="phone-us" defaultCountry="US" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">United Kingdom</span>
                <twig:ui:input:phone name="phone-gb" defaultCountry="GB" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Mali</span>
                <twig:ui:input:phone name="phone-ml" defaultCountry="ML" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Small</span>
                <twig:ui:input:phone name="phone-sm" size="sm" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:input:phone name="phone-md" size="md" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:input:phone name="phone-lg" size="lg" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 4)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:label for="phone-label">Phone Number</twig:ui:label>
            <twig:ui:input:phone name="phone-label" id="phone-label" required />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 5)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:phone name="phone-disabled" disabled />
        </div>
        TWIG);
    }
}
