<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'avatar',
    category: 'core',
    label: 'Avatar',
    description: 'User profile picture or initials display'
)]
class AvatarStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $name = 'User name for generating initials.';

    #[Prop(type: 'string', default: "''")]
    public string $src = 'Image URL for the avatar.';

    #[Prop(type: "'xs'|'sm'|'md'|'lg'|'xl'", default: "'md'")]
    public string $size = 'Avatar size.';

    #[Prop(type: "'online'|'away'|'busy'|'offline'|null", default: 'null')]
    public string $status = 'Status indicator.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Sizes', order: 0)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-4">
            <twig:ui:avatar size="xs" name="John Doe" />
            <twig:ui:avatar size="sm" name="John Doe" />
            <twig:ui:avatar size="md" name="John Doe" />
            <twig:ui:avatar size="lg" name="John Doe" />
            <twig:ui:avatar size="xl" name="John Doe" />
        </div>
        TWIG);
    }

    #[Story('With Image', order: 1)]
    public function withImage(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-4">
            <twig:ui:avatar src="https://i.pravatar.cc/150?img=1" name="Alice" />
            <twig:ui:avatar src="https://i.pravatar.cc/150?img=2" name="Bob" />
            <twig:ui:avatar src="https://i.pravatar.cc/150?img=3" name="Carol" />
        </div>
        TWIG);
    }

    #[Story('Initials (No Image)', order: 2)]
    public function initials(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-4">
            <twig:ui:avatar name="John Doe" />
            <twig:ui:avatar name="Alice Smith" />
            <twig:ui:avatar name="Bob" />
        </div>
        TWIG);
    }

    #[Story('With Status Indicator', order: 3)]
    public function withStatus(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-4">
            <twig:ui:avatar name="Online User" status="online" />
            <twig:ui:avatar name="Away User" status="away" />
            <twig:ui:avatar name="Busy User" status="busy" />
            <twig:ui:avatar name="Offline User" status="offline" />
        </div>
        TWIG);
    }
}
