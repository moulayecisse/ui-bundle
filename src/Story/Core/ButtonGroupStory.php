<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'button-group',
    category: 'core',
    label: 'Button Group',
    description: 'Groups related buttons together with shared styling'
)]
class ButtonGroupStory extends AbstractComponentStory
{
    #[Prop(type: "'horizontal'|'vertical'", default: "'horizontal'")]
    public string $orientation = 'Layout orientation of the button group.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $attached = 'Whether buttons are visually attached (no gap, shared borders).';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Buttons to group together.';

    #[Story('Basic Group', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:button-group>
            <twig:ui:button variant="outline">Left</twig:ui:button>
            <twig:ui:button variant="outline">Middle</twig:ui:button>
            <twig:ui:button variant="outline">Right</twig:ui:button>
        </twig:ui:button-group>
        TWIG);
    }

    #[Story('Solid Buttons', order: 1)]
    public function solid(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:button-group>
            <twig:ui:button>One</twig:ui:button>
            <twig:ui:button>Two</twig:ui:button>
            <twig:ui:button>Three</twig:ui:button>
        </twig:ui:button-group>
        TWIG);
    }

    #[Story('With Icons', order: 2)]
    public function withIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:button-group>
            <twig:ui:button variant="outline">
                <twig:ux:icon name="lucide:align-left" class="size-4" />
            </twig:ui:button>
            <twig:ui:button variant="outline">
                <twig:ux:icon name="lucide:align-center" class="size-4" />
            </twig:ui:button>
            <twig:ui:button variant="outline">
                <twig:ux:icon name="lucide:align-right" class="size-4" />
            </twig:ui:button>
            <twig:ui:button variant="outline">
                <twig:ux:icon name="lucide:align-justify" class="size-4" />
            </twig:ui:button>
        </twig:ui:button-group>
        TWIG);
    }

    #[Story('Vertical Orientation', order: 3)]
    public function vertical(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:button-group orientation="vertical">
            <twig:ui:button variant="outline">Top</twig:ui:button>
            <twig:ui:button variant="outline">Middle</twig:ui:button>
            <twig:ui:button variant="outline">Bottom</twig:ui:button>
        </twig:ui:button-group>
        TWIG);
    }

    #[Story('Detached (with gap)', order: 4)]
    public function detached(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:button-group :attached="false">
                <twig:ui:button variant="outline">One</twig:ui:button>
                <twig:ui:button variant="outline">Two</twig:ui:button>
                <twig:ui:button variant="outline">Three</twig:ui:button>
            </twig:ui:button-group>

            <twig:ui:button-group orientation="vertical" :attached="false">
                <twig:ui:button variant="outline">Top</twig:ui:button>
                <twig:ui:button variant="outline">Middle</twig:ui:button>
                <twig:ui:button variant="outline">Bottom</twig:ui:button>
            </twig:ui:button-group>
        </div>
        TWIG);
    }

    #[Story('Mixed Variants', order: 5)]
    public function mixedVariants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:button-group>
            <twig:ui:button>Primary</twig:ui:button>
            <twig:ui:button variant="outline">
                <twig:ux:icon name="lucide:chevron-down" class="size-4" />
            </twig:ui:button>
        </twig:ui:button-group>
        TWIG);
    }

    #[Story('Toolbar Example', order: 6)]
    public function toolbar(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-center gap-4">
            <twig:ui:button-group>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:bold" class="size-4" />
                </twig:ui:button>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:italic" class="size-4" />
                </twig:ui:button>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:underline" class="size-4" />
                </twig:ui:button>
            </twig:ui:button-group>

            <twig:ui:button-group>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:list" class="size-4" />
                </twig:ui:button>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:list-ordered" class="size-4" />
                </twig:ui:button>
            </twig:ui:button-group>

            <twig:ui:button-group>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:link" class="size-4" />
                </twig:ui:button>
                <twig:ui:button variant="outline" size="sm">
                    <twig:ux:icon name="lucide:image" class="size-4" />
                </twig:ui:button>
            </twig:ui:button-group>
        </div>
        TWIG);
    }

    #[Story('Colors', order: 7)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:button-group>
                <twig:ui:button color="success">Save</twig:ui:button>
                <twig:ui:button color="success" variant="outline">
                    <twig:ux:icon name="lucide:chevron-down" class="size-4" />
                </twig:ui:button>
            </twig:ui:button-group>

            <twig:ui:button-group>
                <twig:ui:button color="danger" variant="outline">Delete</twig:ui:button>
                <twig:ui:button color="danger" variant="outline">Remove All</twig:ui:button>
            </twig:ui:button-group>
        </div>
        TWIG);
    }

    #[Story('Pagination Example', order: 8)]
    public function pagination(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:button-group>
            <twig:ui:button variant="outline" size="sm">
                <twig:ux:icon name="lucide:chevron-left" class="size-4" />
            </twig:ui:button>
            <twig:ui:button variant="outline" size="sm">1</twig:ui:button>
            <twig:ui:button variant="outline" size="sm">2</twig:ui:button>
            <twig:ui:button size="sm">3</twig:ui:button>
            <twig:ui:button variant="outline" size="sm">4</twig:ui:button>
            <twig:ui:button variant="outline" size="sm">5</twig:ui:button>
            <twig:ui:button variant="outline" size="sm">
                <twig:ux:icon name="lucide:chevron-right" class="size-4" />
            </twig:ui:button>
        </twig:ui:button-group>
        TWIG);
    }
}
