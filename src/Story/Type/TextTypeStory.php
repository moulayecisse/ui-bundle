<?php

namespace Cisse\Bundle\Ui\Story\Type;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'text-type',
    category: 'type',
    label: 'Text Type',
    description: 'Display text values with truncation, linking, and copy functionality'
)]
class TextTypeStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $value = 'Text value to display';

    #[Prop(type: 'string', default: "''")]
    public string $placeholder = 'Text to show when value is empty';

    #[Prop(type: 'boolean', default: 'false')]
    public string $truncate = 'Truncate text with ellipsis when too long';

    #[Prop(type: 'string | null', default: 'null')]
    public string $href = 'URL to make text a link';

    #[Prop(type: 'boolean', default: 'false')]
    public string $copyable = 'Show copy button to copy value';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Text', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:text value="Hello, World!" />
        TWIG);
    }

    #[Story('Empty with Placeholder', order: 1)]
    public function placeholder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:text value="" placeholder="No value" />
        TWIG);
    }

    #[Story('Truncated', order: 2)]
    public function truncated(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xs">
            <twig:ui:type:text value="This is a very long text that should be truncated when it exceeds the container width" truncate />
        </div>
        TWIG);
    }

    #[Story('As Link', order: 3)]
    public function asLink(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:text value="Click here" href="https://example.com" />
        TWIG);
    }

    #[Story('With Copy Button', order: 4)]
    public function copyable(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:text value="user@example.com" copyable />
        TWIG);
    }
}
