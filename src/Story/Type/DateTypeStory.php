<?php

namespace Cisse\Bundle\Ui\Story\Type;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'date-type',
    category: 'type',
    label: 'Date Type',
    description: 'Format and display dates with various formatting options'
)]
class DateTypeStory extends AbstractComponentStory
{
    #[Prop(type: 'string|DateTimeInterface', default: "''")]
    public string $value = 'Date value to display.';

    #[Prop(type: "'short'|'medium'|'long'|'full'", default: "'medium'")]
    public string $format = 'Date format preset.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showTime = 'Include time in output.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $relative = 'Show relative time (e.g., "2 hours ago").';

    #[Prop(type: 'string', default: "''")]
    public string $placeholder = 'Text to show when value is empty.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Default Format', order: 0)]
    public function defaultFormat(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:date value="2024-01-15" />
        TWIG);
    }

    #[Story('Different Formats', order: 1)]
    public function formats(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-2">
            <div>Short: <twig:ui:type:date value="2024-01-15" format="short" /></div>
            <div>Medium: <twig:ui:type:date value="2024-01-15" format="medium" /></div>
            <div>Long: <twig:ui:type:date value="2024-01-15" format="long" /></div>
            <div>Full: <twig:ui:type:date value="2024-01-15" format="full" /></div>
        </div>
        TWIG);
    }

    #[Story('With Time', order: 2)]
    public function withTime(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:date value="2024-01-15 14:30:00" showTime />
        TWIG);
    }

    #[Story('Relative Time', order: 3)]
    public function relativeTime(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:date value="now" relative />
        TWIG);
    }

    #[Story('Empty with Placeholder', order: 4)]
    public function placeholder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:date value="" placeholder="Not set" />
        TWIG);
    }
}
