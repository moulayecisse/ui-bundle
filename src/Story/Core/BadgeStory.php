<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'badge',
    category: 'core',
    label: 'Badge',
    description: 'Small status indicators and labels'
)]
class BadgeStory extends AbstractComponentStory
{
    #[Prop(type: "'solid'|'outline'|'soft'", default: "'solid'")]
    public string $variant = 'Badge style variant';

    #[Prop(type: "'primary'|'secondary'|'success'|'warning'|'danger'|'info'|'white'|'light'", default: "'primary'")]
    public string $color = 'Badge color theme';

    #[Prop(type: "'sm'|'default'|'lg'", default: "'default'")]
    public string $size = 'Badge size';

    #[Prop(type: 'string', default: "''")]
    public string $href = 'If provided, renders as <a> link instead of <span>';

    #[Prop(type: 'boolean', default: 'false')]
    public string $dot = 'Show a colored dot indicator';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Badge content (default slot)';

    #[Story('Solid Variant (default)', order: 0)]
    public function solid(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge color="primary">Primary</twig:ui:badge>
            <twig:ui:badge color="secondary">Secondary</twig:ui:badge>
            <twig:ui:badge color="success">Success</twig:ui:badge>
            <twig:ui:badge color="warning">Warning</twig:ui:badge>
            <twig:ui:badge color="danger">Danger</twig:ui:badge>
            <twig:ui:badge color="info">Info</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('Outline Variant', order: 1)]
    public function outline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge variant="outline" color="primary">Primary</twig:ui:badge>
            <twig:ui:badge variant="outline" color="secondary">Secondary</twig:ui:badge>
            <twig:ui:badge variant="outline" color="success">Success</twig:ui:badge>
            <twig:ui:badge variant="outline" color="warning">Warning</twig:ui:badge>
            <twig:ui:badge variant="outline" color="danger">Danger</twig:ui:badge>
            <twig:ui:badge variant="outline" color="info">Info</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('Soft Variant', order: 2)]
    public function soft(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge variant="soft" color="primary">Primary</twig:ui:badge>
            <twig:ui:badge variant="soft" color="secondary">Secondary</twig:ui:badge>
            <twig:ui:badge variant="soft" color="success">Success</twig:ui:badge>
            <twig:ui:badge variant="soft" color="warning">Warning</twig:ui:badge>
            <twig:ui:badge variant="soft" color="danger">Danger</twig:ui:badge>
            <twig:ui:badge variant="soft" color="info">Info</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('Special Colors', order: 3)]
    public function specialColors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge color="white">White</twig:ui:badge>
            <twig:ui:badge color="light">Light</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-3">
            <twig:ui:badge size="sm" color="primary">Small</twig:ui:badge>
            <twig:ui:badge size="default" color="primary">Default</twig:ui:badge>
            <twig:ui:badge size="lg" color="primary">Large</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('With Dot Indicator', order: 5)]
    public function withDot(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge color="success" dot>Online</twig:ui:badge>
            <twig:ui:badge color="danger" dot>Offline</twig:ui:badge>
            <twig:ui:badge color="warning" dot>Away</twig:ui:badge>
            <twig:ui:badge color="info" dot>Busy</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('As Link', order: 6)]
    public function asLink(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge color="primary" href="#">Clickable Badge</twig:ui:badge>
            <twig:ui:badge variant="outline" color="info" href="#">Link Badge</twig:ui:badge>
        </div>
        TWIG);
    }

    #[Story('Practical Examples', order: 7)]
    public function examples(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-3">
            <twig:ui:badge color="success" dot>Active</twig:ui:badge>
            <twig:ui:badge color="warning">Pending</twig:ui:badge>
            <twig:ui:badge variant="outline" color="info">v1.2.3</twig:ui:badge>
            <twig:ui:badge variant="soft" color="primary">New</twig:ui:badge>
            <twig:ui:badge color="danger">5</twig:ui:badge>
        </div>
        TWIG);
    }
}
