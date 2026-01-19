<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'form-section/header',
    category: 'form',
    label: 'Form Section Header',
    description: 'Lightweight section divider for forms with inline or card variants'
)]
class FormSectionHeaderStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $icon = 'Icon name (Symfony UX Icons format, e.g., heroicons:user)';

    #[Prop(type: "'primary' | 'secondary' | 'gray' | 'success' | 'warning' | 'danger'", default: "'primary'")]
    public string $iconColor = 'Icon color theme';

    #[Prop(type: 'string | null', default: 'null')]
    public string $subtitle = 'Subtitle text (card variant only)';

    #[Prop(type: 'boolean', default: 'false')]
    public string $bordered = 'Show top border separator';

    #[Prop(type: "'inline' | 'card'", default: "'inline'")]
    public string $variant = 'Header style variant';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Header title text (default slot)';

    #[Slot]
    public string $actions = 'Action buttons (card variant only)';

    #[NestedAttribute]
    public string $iconAttr = 'Customize icon styling';

    #[NestedAttribute]
    public string $title = 'Customize title styling';

    #[NestedAttribute]
    public string $subtitleAttr = 'Customize subtitle styling';

    #[Story('Inline Variant (default)', order: 0)]
    public function inline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-2xl">
            <twig:ui:form-section:header icon="heroicons:user">
                Personal Information
            </twig:ui:form-section:header>
            <twig:ui:input-group name="firstName" label:text="First Name" :col="6" />
            <twig:ui:input-group name="lastName" label:text="Last Name" :col="6" />

            <twig:ui:form-section:header icon="heroicons:envelope" iconColor="secondary" bordered>
                Contact Details
            </twig:ui:form-section:header>
            <twig:ui:input-group name="email" type="email" label:text="Email" :col="6" />
            <twig:ui:input-group name="phone" label:text="Phone" :col="6" />
        </div>
        TWIG);
    }

    #[Story('Icon Colors', order: 1)]
    public function iconColors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-4 max-w-xl">
            <twig:ui:form-section:header icon="heroicons:star" iconColor="primary">
                Primary
            </twig:ui:form-section:header>
            <twig:ui:form-section:header icon="heroicons:heart" iconColor="secondary">
                Secondary
            </twig:ui:form-section:header>
            <twig:ui:form-section:header icon="heroicons:cog-6-tooth" iconColor="gray">
                Gray
            </twig:ui:form-section:header>
            <twig:ui:form-section:header icon="heroicons:check-circle" iconColor="success">
                Success
            </twig:ui:form-section:header>
            <twig:ui:form-section:header icon="heroicons:exclamation-triangle" iconColor="warning">
                Warning
            </twig:ui:form-section:header>
            <twig:ui:form-section:header icon="heroicons:x-circle" iconColor="danger">
                Danger
            </twig:ui:form-section:header>
        </div>
        TWIG);
    }

    #[Story('With Border', order: 2)]
    public function withBorder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-xl">
            <twig:ui:form-section:header icon="heroicons:building-office-2">
                Section One
            </twig:ui:form-section:header>
            <p class="col-span-12 text-gray-600 dark:text-gray-400">Content for section one...</p>

            <twig:ui:form-section:header icon="heroicons:users" bordered>
                Section Two (with border)
            </twig:ui:form-section:header>
            <p class="col-span-12 text-gray-600 dark:text-gray-400">Content for section two...</p>

            <twig:ui:form-section:header icon="heroicons:document-text" bordered>
                Section Three (with border)
            </twig:ui:form-section:header>
            <p class="col-span-12 text-gray-600 dark:text-gray-400">Content for section three...</p>
        </div>
        TWIG);
    }

    #[Story('Card Variant', order: 3)]
    public function cardVariant(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-xl">
            <twig:ui:form-section:header
                variant="card"
                icon="heroicons:user-circle"
                iconColor="primary"
                subtitle="Manage your profile settings"
            >
                Profile Settings
            </twig:ui:form-section:header>

            <twig:ui:form-section:header
                variant="card"
                icon="heroicons:shield-check"
                iconColor="success"
                subtitle="Configure security options"
                bordered
            >
                Security
            </twig:ui:form-section:header>
        </div>
        TWIG);
    }

    #[Story('Card Variant with Actions', order: 4)]
    public function cardWithActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-xl">
            <twig:ui:form-section:header
                variant="card"
                icon="heroicons:bell"
                iconColor="info"
                subtitle="Choose how you want to be notified"
            >
                <twig:block name="actions">
                    <twig:ui:button variant="ghost" size="sm">Reset</twig:ui:button>
                </twig:block>
                Notifications
            </twig:ui:form-section:header>
        </div>
        TWIG);
    }

    #[Story('Without Icon', order: 5)]
    public function withoutIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-xl">
            <twig:ui:form-section:header>
                Simple Section Header
            </twig:ui:form-section:header>

            <twig:ui:form-section:header bordered>
                Another Section (with border)
            </twig:ui:form-section:header>

            <twig:ui:form-section:header variant="card" subtitle="Card variant without icon">
                Card Section
            </twig:ui:form-section:header>
        </div>
        TWIG);
    }
}
