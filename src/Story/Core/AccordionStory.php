<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'accordion',
    category: 'core',
    label: 'Accordion',
    description: 'Collapsible content panels for organizing information'
)]
class AccordionStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes for the accordion container.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $active = 'ID of initially open item.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $multiple = 'Allow multiple items to be open simultaneously.';

    #[Prop(type: 'number', default: '300')]
    public string $duration = 'Animation duration in milliseconds.';

    #[Prop(type: 'string', default: "'ease-out'")]
    public string $easing = 'Animation easing function.';

    #[Prop(type: "'default'|'bordered'|'separated'|'card'", default: "'default'")]
    public string $variant = 'Visual style variant.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Accordion item size.';

    #[Prop(type: "'left'|'right'", default: "'right'")]
    public string $iconPosition = 'Position of expand/collapse icon.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $flush = 'Remove borders between items.';

    #[Slot]
    public string $content = 'Accordion items.';

    #[Story('Basic Accordion', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:accordion>
            <twig:ui:accordion:item title="What is Vue.js?">
                Vue.js is a progressive JavaScript framework for building user interfaces.
            </twig:ui:accordion:item>
            <twig:ui:accordion:item title="How do I get started?">
                You can start by reading the official documentation at vuejs.org.
            </twig:ui:accordion:item>
            <twig:ui:accordion:item title="What about TypeScript support?">
                Vue 3 has excellent TypeScript support out of the box.
            </twig:ui:accordion:item>
        </twig:ui:accordion>
        TWIG);
    }

    #[Story('With Icons', order: 1)]
    public function withIcons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:accordion>
            <twig:ui:accordion:item title="Account Settings" icon="heroicons:user">
                Manage your account preferences and profile information.
            </twig:ui:accordion:item>
            <twig:ui:accordion:item title="Security" icon="heroicons:shield-check">
                Configure your security settings and two-factor authentication.
            </twig:ui:accordion:item>
        </twig:ui:accordion>
        TWIG);
    }

    #[Story('With Badges', order: 2)]
    public function withBadges(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:accordion>
            <twig:ui:accordion:item title="New Features" badge="3 new">
                Check out the latest features we've added.
            </twig:ui:accordion:item>
        </twig:ui:accordion>
        TWIG);
    }

    #[Story('Multiple Open', order: 3)]
    public function multipleOpen(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:accordion :multiple="true">
            <twig:ui:accordion:item title="Section One">Content for section one.</twig:ui:accordion:item>
            <twig:ui:accordion:item title="Section Two">Content for section two.</twig:ui:accordion:item>
        </twig:ui:accordion>
        TWIG);
    }

    #[Story('Variant Examples', order: 4)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-8">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-2">Bordered Variant</p>
                <twig:ui:accordion variant="bordered">
                    <twig:ui:accordion:item title="Bordered Item">Content with border styling.</twig:ui:accordion:item>
                </twig:ui:accordion>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-2">Card Variant</p>
                <twig:ui:accordion variant="card">
                    <twig:ui:accordion:item title="Card Item">Content with card styling.</twig:ui:accordion:item>
                </twig:ui:accordion>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-2">Separated Variant</p>
                <twig:ui:accordion variant="separated">
                    <twig:ui:accordion:item title="Separated Item">Content with separated styling.</twig:ui:accordion:item>
                </twig:ui:accordion>
            </div>
        </div>
        TWIG);
    }

    #[Story('Size Options', order: 5)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:accordion size="sm">
                <twig:ui:accordion:item title="Small Size">Small content.</twig:ui:accordion:item>
            </twig:ui:accordion>
            <twig:ui:accordion size="md">
                <twig:ui:accordion:item title="Medium Size">Medium content.</twig:ui:accordion:item>
            </twig:ui:accordion>
            <twig:ui:accordion size="lg">
                <twig:ui:accordion:item title="Large Size">Large content.</twig:ui:accordion:item>
            </twig:ui:accordion>
        </div>
        TWIG);
    }
}
