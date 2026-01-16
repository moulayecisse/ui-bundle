<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'date-picker',
    category: 'form',
    label: 'Date Picker',
    description: 'Native date input with various types'
)]
class DatePickerStory extends AbstractComponentStory
{
    #[Prop(type: "'date' | 'datetime-local' | 'time' | 'month' | 'week'", default: "'date'")]
    public string $type = 'Input type for date selection';

    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Input element ID';

    #[Prop(type: 'string | null', default: 'null')]
    public string $value = 'Date value (YYYY-MM-DD format)';

    #[Prop(type: 'string', default: "'YYYY-MM-DD'")]
    public string $placeholder = 'Placeholder text';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Required field';

    #[Prop(type: 'boolean', default: 'false')]
    public string $autofocus = 'Autofocus on page load';

    #[Prop(type: 'string | null', default: 'null')]
    public string $autocomplete = 'Autocomplete attribute';

    #[Prop(type: 'FormView | null', default: 'null')]
    public string $form = 'Symfony form field for auto-configuration';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Date Picker', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:date name="date" />
        </div>
        TWIG);
    }

    #[Story('With Pre-filled Value', order: 1)]
    public function preFilled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:date name="date-value" value="2024-06-15" />
        </div>
        TWIG);
    }

    #[Story('Different Types', order: 2)]
    public function types(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs space-y-4">
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Date</span>
                <twig:ui:input:date name="date-type" type="date" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Date & Time</span>
                <twig:ui:input:date name="datetime-type" type="datetime-local" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Time only</span>
                <twig:ui:input:date name="time-type" type="time" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Month</span>
                <twig:ui:input:date name="month-type" type="month" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-1 block">Week</span>
                <twig:ui:input:date name="week-type" type="week" />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Label', order: 3)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:label for="birth-date">Birth Date</twig:ui:label>
            <twig:ui:input:date name="birth-date" id="birth-date" required />
        </div>
        TWIG);
    }

    #[Story('Date Range Example', order: 4)]
    public function dateRange(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <twig:ui:label for="start-date">Start Date</twig:ui:label>
                    <twig:ui:input:date name="start-date" id="start-date" />
                </div>
                <div>
                    <twig:ui:label for="end-date">End Date</twig:ui:label>
                    <twig:ui:input:date name="end-date" id="end-date" />
                </div>
            </div>
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 5)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:input:date name="date-disabled" value="2024-01-01" disabled />
        </div>
        TWIG);
    }
}
