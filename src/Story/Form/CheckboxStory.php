<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'checkbox',
    category: 'form',
    label: 'Checkbox',
    description: 'Checkbox input for boolean selection'
)]
class CheckboxStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name for submission.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $value = 'Value when checked.';

    #[Prop(type: 'boolean|null', default: 'null')]
    public string $checked = 'Whether checkbox is checked.';

    #[Prop(type: 'boolean|null', default: 'null')]
    public string $required = 'Whether field is required.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $autofocus = 'Autofocus on page load.';

    #[Prop(type: 'boolean|null', default: 'null')]
    public string $disabled = 'Disable the checkbox.';

    #[Prop(type: 'FormView|null', default: 'null')]
    public string $form = 'Symfony form field for auto-configuration.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Checkbox', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-2">
            <twig:ui:input:checkbox name="basic" id="basic" />
            <label for="basic" class="text-sm text-gray-700 dark:text-gray-300">Basic Checkbox</label>
        </div>
        TWIG);
    }

    #[Story('Checked by Default', order: 1)]
    public function checked(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-2">
            <twig:ui:input:checkbox name="checked" id="checked" checked />
            <label for="checked" class="text-sm text-gray-700 dark:text-gray-300">Checked by Default</label>
        </div>
        TWIG);
    }

    #[Story('Multiple Checkboxes', order: 2)]
    public function multiple(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <twig:ui:input:checkbox name="features[]" id="feature1" value="notifications" checked />
                <label for="feature1" class="text-sm text-gray-700 dark:text-gray-300">Email notifications</label>
            </div>
            <div class="flex items-center gap-2">
                <twig:ui:input:checkbox name="features[]" id="feature2" value="newsletter" />
                <label for="feature2" class="text-sm text-gray-700 dark:text-gray-300">Newsletter subscription</label>
            </div>
            <div class="flex items-center gap-2">
                <twig:ui:input:checkbox name="features[]" id="feature3" value="updates" checked />
                <label for="feature3" class="text-sm text-gray-700 dark:text-gray-300">Product updates</label>
            </div>
        </div>
        TWIG);
    }

    #[Story('Disabled States', order: 3)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <twig:ui:input:checkbox name="disabled1" id="disabled1" disabled />
                <label for="disabled1" class="text-sm text-gray-400">Disabled Unchecked</label>
            </div>
            <div class="flex items-center gap-2">
                <twig:ui:input:checkbox name="disabled2" id="disabled2" disabled checked />
                <label for="disabled2" class="text-sm text-gray-400">Disabled Checked</label>
            </div>
        </div>
        TWIG);
    }
}
