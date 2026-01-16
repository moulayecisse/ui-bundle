<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'password-input',
    category: 'form',
    label: 'Password Input',
    description: 'Password input with visibility toggle and strength indicator'
)]
class PasswordInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Input element ID';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Input value';

    #[Prop(type: 'string', default: "'Enter password...'")]
    public string $placeholder = 'Placeholder text';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Input size';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showStrength = 'Show password strength indicator';

    #[Prop(type: 'number', default: '8')]
    public string $minLength = 'Minimum password length for strength calculation';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Password Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:password name="password" placeholder="Enter your password..." />
        </div>
        TWIG);
    }

    #[Story('With Visibility Toggle', order: 1)]
    public function withToggle(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Click the eye icon to toggle password visibility.
            </p>
            <twig:ui:input:password name="password-toggle" placeholder="Click the eye to show/hide..." />
        </div>
        TWIG);
    }

    #[Story('With Strength Indicator', order: 2)]
    public function withStrength(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Type a password to see the strength indicator. Try combinations of lowercase, uppercase, numbers, and special characters.
            </p>
            <twig:ui:input:password name="password-strength" :showStrength="true" placeholder="Enter a strong password..." />
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
                <twig:ui:input:password name="password-sm" size="sm" placeholder="Small" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:input:password name="password-md" size="md" placeholder="Medium" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:input:password name="password-lg" size="lg" placeholder="Large" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 4)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:label for="password-label">Password</twig:ui:label>
            <twig:ui:input:password name="password-label" id="password-label" :showStrength="true" required />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 5)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:password name="password-disabled" value="secretpass" disabled />
        </div>
        TWIG);
    }
}
