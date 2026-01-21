<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'url-input',
    category: 'form',
    label: 'URL Input',
    description: 'URL input with validation and external link button'
)]
class UrlInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Input value.';

    #[Prop(type: 'string', default: "'https://example.com'")]
    public string $placeholder = 'Placeholder text.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showValidation = 'Show validation state.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic URL Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:url name="website" placeholder="https://example.com" />
        </div>
        TWIG);
    }

    #[Story('With Validation', order: 1)]
    public function withValidation(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Type a URL and blur (click outside) to see validation. Valid URLs show an external link button, invalid URLs show an error icon.
            </p>
            <twig:ui:input:url name="url-validate" :showValidation="true" placeholder="Enter a URL..." />
        </div>
        TWIG);
    }

    #[Story('Pre-filled Value', order: 2)]
    public function preFilled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Valid URL</span>
                <twig:ui:input:url name="url-valid" value="https://example.com" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Another valid URL</span>
                <twig:ui:input:url name="url-valid2" value="https://github.com/username/repo" />
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
                <twig:ui:input:url name="url-sm" size="sm" placeholder="Small URL input" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Medium (default)</span>
                <twig:ui:input:url name="url-md" size="md" placeholder="Medium URL input" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Large</span>
                <twig:ui:input:url name="url-lg" size="lg" placeholder="Large URL input" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 4)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:label for="url-label">Website URL</twig:ui:label>
            <twig:ui:input:url name="url-label" id="url-label" required />
        </div>
        TWIG);
    }

    #[Story('Without Validation', order: 5)]
    public function withoutValidation(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Validation icons are hidden when <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">showValidation="false"</code>.
            </p>
            <twig:ui:input:url name="url-no-validate" :showValidation="false" placeholder="No validation indicators..." />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input:url name="url-disabled" value="https://disabled.example.com" disabled />
        </div>
        TWIG);
    }
}
