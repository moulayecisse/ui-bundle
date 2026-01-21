<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'switch',
    category: 'form',
    label: 'Switch',
    description: 'Toggle switch for boolean settings'
)]
class SwitchStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: 'null')]
    public string $name = 'Input name attribute.';

    #[Prop(type: 'string', default: 'null')]
    public string $id = 'Input id attribute.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $checked = 'Whether the switch is on.';

    #[Prop(type: 'string', default: 'null')]
    public string $label = 'Label text next to the switch.';

    #[Prop(type: 'string', default: 'null')]
    public string $description = 'Description text below the label.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the switch.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Mark as required field.';

    #[Prop(type: 'string', default: "'md'")]
    public string $size = 'Switch size (sm, md, lg).';

    #[Prop(type: 'string', default: "'primary'")]
    public string $color = 'Switch color when on (primary, success, warning, danger, info).';

    #[Prop(type: 'string', default: "'right'")]
    public string $labelPosition = 'Position of label (left, right).';

    #[Prop(type: 'string', default: "'1'")]
    public string $value = 'Value when checked.';

    #[Story('Basic Switch', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:switch name="basic" label="Basic Switch" />
        TWIG);
    }

    #[Story('Color Variants', order: 1)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:switch name="primary" label="Primary" color="primary" checked />
            <twig:ui:switch name="success" label="Success" color="success" checked />
            <twig:ui:switch name="warning" label="Warning" color="warning" checked />
            <twig:ui:switch name="danger" label="Danger" color="danger" checked />
            <twig:ui:switch name="info" label="Info" color="info" checked />
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:switch name="small" label="Small" size="sm" />
            <twig:ui:switch name="medium" label="Medium (default)" size="md" />
            <twig:ui:switch name="large" label="Large" size="lg" />
        </div>
        TWIG);
    }

    #[Story('With Description', order: 3)]
    public function withDescription(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:switch name="description" label="Email Notifications" description="Receive email updates about your account." />
        TWIG);
    }

    #[Story('Label Position', order: 4)]
    public function labelPosition(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:switch name="right-label" label="Label on right" labelPosition="right" checked />
            <twig:ui:switch name="left-label" label="Label on left" labelPosition="left" checked />
        </div>
        TWIG);
    }

    #[Story('Required Field', order: 5)]
    public function requiredField(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:switch name="required" label="Accept Terms" description="You must accept the terms to continue." required />
        TWIG);
    }

    #[Story('Disabled States', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-3">
            <twig:ui:switch name="disabled-off" label="Disabled (Off)" disabled />
            <twig:ui:switch name="disabled-on" label="Disabled (On)" disabled checked />
        </div>
        TWIG);
    }

    #[Story('Settings Example', order: 7)]
    public function settingsExample(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4 max-w-md">
            <twig:ui:switch name="dark-mode" label="Dark Mode" description="Switch to dark color scheme" checked color="primary" />
            <twig:ui:switch name="notifications" label="Push Notifications" description="Receive push notifications on your device" color="info" />
            <twig:ui:switch name="marketing" label="Marketing Emails" description="Receive promotional emails and offers" color="success" />
            <twig:ui:switch name="sounds" label="Sound Effects" description="Play sounds for interactions" checked color="primary" />
        </div>
        TWIG);
    }
}
