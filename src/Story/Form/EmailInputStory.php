<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'email-input',
    category: 'form',
    label: 'Email Input',
    description: 'Email input with built-in validation'
)]
class EmailInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Input value.';

    #[Prop(type: 'string', default: "'Enter email address...'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showValidation = 'Show validation icons.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Email Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:email name="email" placeholder="Enter your email..." />
        </div>
        TWIG);
    }

    #[Story('With Label', order: 1)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:label for="email-label">Email Address</twig:ui:label>
            <twig:ui:input:email name="email-label" id="email-label" required />
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
                <twig:ui:input:email name="email-sm" size="sm" placeholder="Small email input" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:input:email name="email-md" size="md" placeholder="Medium email input" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:input:email name="email-lg" size="lg" placeholder="Large email input" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Validation', order: 3)]
    public function validation(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Type in the input and blur (click outside) to see validation. Valid emails show a green checkmark, invalid emails show a red alert icon.
            </p>
            <twig:ui:input:email name="email-validate" :showValidation="true" placeholder="Type and blur to validate..." />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 4)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:email name="email-disabled" value="user@example.com" disabled />
        </div>
        TWIG);
    }
}
