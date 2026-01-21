<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'collapsible-card',
    category: 'core',
    label: 'Collapsible Card',
    description: 'Card with expandable/collapsible content section'
)]
class CollapsibleCardStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $title = 'Card title displayed in header.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $description = 'Card description below title.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $defaultExpanded = 'Initial expanded/collapsed state.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes for container.';

    #[Slot]
    public string $header = 'Custom header content (replaces title/description mode).';

    #[Slot]
    public string $actions = 'Action buttons next to the collapse toggle.';

    #[Slot]
    public string $content = 'Main card content (default slot).';

    #[NestedAttribute]
    public string $card = 'Customize the card container.';

    #[NestedAttribute]
    public string $headerAttr = 'Customize the header button.';

    #[NestedAttribute]
    public string $contentAttr = 'Customize the content wrapper.';

    #[Story('Basic Collapsible Card', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:collapsible-card title="Account Settings">
                <p class="text-gray-600 dark:text-gray-400">
                    Manage your account settings and preferences here.
                </p>
            </twig:ui:collapsible-card>
        </div>
        TWIG);
    }

    #[Story('With Description', order: 1)]
    public function withDescription(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:collapsible-card title="Notifications" description="Configure how you receive notifications">
                <div class="space-y-3">
                    <twig:ui:switch name="email" label="Email notifications" checked />
                    <twig:ui:switch name="push" label="Push notifications" />
                </div>
            </twig:ui:collapsible-card>
        </div>
        TWIG);
    }

    #[Story('Collapsed by Default', order: 2)]
    public function collapsedByDefault(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:collapsible-card title="Advanced Options" :defaultExpanded="false">
                <p class="text-gray-600 dark:text-gray-400">
                    These are advanced options that are hidden by default.
                </p>
            </twig:ui:collapsible-card>
        </div>
        TWIG);
    }

    #[Story('Multiple Cards', order: 3)]
    public function multipleCards(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:collapsible-card title="Personal Information">
                <p class="text-gray-600 dark:text-gray-400">Your personal details and information.</p>
            </twig:ui:collapsible-card>
            <twig:ui:collapsible-card title="Security" :defaultExpanded="false">
                <p class="text-gray-600 dark:text-gray-400">Security and privacy settings.</p>
            </twig:ui:collapsible-card>
            <twig:ui:collapsible-card title="Billing" :defaultExpanded="false">
                <p class="text-gray-600 dark:text-gray-400">Billing and payment information.</p>
            </twig:ui:collapsible-card>
        </div>
        TWIG);
    }
}
