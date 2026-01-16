<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'icon-picker',
    category: 'form',
    label: 'Icon Picker',
    description: 'Searchable icon selector using Iconify API'
)]
class IconPickerStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'icon'")]
    public string $name = 'Form field name';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Input element ID';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Selected icon name (e.g., "mdi:heart")';

    #[Prop(type: 'string | null', default: 'null')]
    public string $label = 'Label text';

    #[Prop(type: 'string', default: "'Search for an icon...'")]
    public string $placeholder = 'Placeholder text';

    #[Prop(type: 'string | null', default: 'null')]
    public string $help = 'Help text below input';

    #[Prop(type: 'string | null', default: 'null')]
    public string $error = 'Error message';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state';

    #[Prop(type: 'string', default: "'mdi,heroicons,lucide'")]
    public string $collections = 'Comma-separated icon collection names for search';

    #[Prop(type: 'number', default: '48')]
    public string $limit = 'Maximum icons to show in search results';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Icon Picker', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon" />
        </div>
        TWIG);
    }

    #[Story('With Label', order: 1)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon-label" label="Select an Icon" />
        </div>
        TWIG);
    }

    #[Story('With Pre-selected Value', order: 2)]
    public function preSelected(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon-value" label="Category Icon" value="mdi:heart" />
        </div>
        TWIG);
    }

    #[Story('With Help Text', order: 3)]
    public function withHelp(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon-help" label="Choose Icon" help="Search or select from popular icons" />
        </div>
        TWIG);
    }

    #[Story('Required', order: 4)]
    public function required(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon-required" label="Icon" required />
        </div>
        TWIG);
    }

    #[Story('With Error', order: 5)]
    public function withError(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon-error" label="Icon" error="Please select an icon" />
        </div>
        TWIG);
    }

    #[Story('Custom Collections', order: 6)]
    public function customCollections(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Restrict search to specific icon collections.
            </p>
            <twig:ui:icon-picker name="icon-collections" label="Heroicons Only" collections="heroicons" />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 7)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm">
            <twig:ui:icon-picker name="icon-disabled" label="Icon" value="mdi:star" disabled />
        </div>
        TWIG);
    }
}
