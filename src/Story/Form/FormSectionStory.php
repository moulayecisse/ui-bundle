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
    name: 'form-section',
    category: 'form',
    label: 'Form Section',
    description: 'Grouped form section with header, optional icon, and collapsible content'
)]
class FormSectionStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $title = 'Section title';

    #[Prop(type: 'string | null', default: 'null')]
    public string $subtitle = 'Optional subtitle below title';

    #[Prop(type: 'string | null', default: 'null')]
    public string $icon = 'Icon name (Symfony UX Icons format, e.g., heroicons:lock-closed)';

    #[Prop(type: "'primary' | 'secondary' | 'gray' | 'success' | 'warning' | 'danger'", default: "'primary'")]
    public string $iconColor = 'Icon background and text color';

    #[Prop(type: 'boolean', default: 'true')]
    public string $bordered = 'Show border and shadow';

    #[Prop(type: 'boolean', default: 'false')]
    public string $collapsible = 'Enable collapse/expand functionality';

    #[Prop(type: 'boolean', default: 'false')]
    public string $collapsed = 'Initial collapsed state';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $header_actions = 'Action buttons in the header';

    #[Slot]
    public string $content = 'Section content (form fields)';

    #[Slot]
    public string $footer = 'Optional footer content';

    #[NestedAttribute]
    public string $header = 'Customize the header container';

    #[NestedAttribute]
    public string $iconAttr = 'Customize the icon container';

    #[NestedAttribute]
    public string $titleAttr = 'Customize the title element';

    #[NestedAttribute]
    public string $subtitleAttr = 'Customize the subtitle element';

    #[NestedAttribute]
    public string $toggle = 'Customize the collapse toggle button';

    #[NestedAttribute]
    public string $contentAttr = 'Customize the content container';

    #[NestedAttribute]
    public string $footerAttr = 'Customize the footer container';

    #[Story('Basic Section', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form-section title="Personal Information">
            <twig:block name="content">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <twig:ui:input-group label="First Name">
                        <twig:ui:input name="first_name" placeholder="John" />
                    </twig:ui:input-group>
                    <twig:ui:input-group label="Last Name">
                        <twig:ui:input name="last_name" placeholder="Doe" />
                    </twig:ui:input-group>
                </div>
            </twig:block>
        </twig:ui:form-section>
        TWIG);
    }

    #[Story('With Subtitle', order: 1)]
    public function withSubtitle(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form-section title="Account Settings" subtitle="Manage your account preferences">
            <twig:block name="content">
                <div class="space-y-4">
                    <twig:ui:input-group label="Email">
                        <twig:ui:input type="email" name="email" placeholder="john@example.com" />
                    </twig:ui:input-group>
                    <twig:ui:input-group label="Username">
                        <twig:ui:input name="username" placeholder="johndoe" />
                    </twig:ui:input-group>
                </div>
            </twig:block>
        </twig:ui:form-section>
        TWIG);
    }

    #[Story('With Icon', order: 2)]
    public function withIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form-section
            title="Security"
            subtitle="Update your security settings"
            icon="heroicons:lock-closed"
        >
            <twig:block name="content">
                <div class="space-y-4">
                    <twig:ui:input-group label="Current Password">
                        <twig:ui:input type="password" name="current_password" />
                    </twig:ui:input-group>
                    <twig:ui:input-group label="New Password">
                        <twig:ui:input type="password" name="new_password" />
                    </twig:ui:input-group>
                </div>
            </twig:block>
        </twig:ui:form-section>
        TWIG);
    }

    #[Story('Icon Colors', order: 3)]
    public function iconColors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:form-section
                title="Primary"
                iconColor="primary"
                icon="heroicons:cog-6-tooth"
            >
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">Primary colored icon</p>
                </twig:block>
            </twig:ui:form-section>

            <twig:ui:form-section
                title="Success"
                iconColor="success"
                icon="heroicons:check-circle"
            >
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">Success colored icon</p>
                </twig:block>
            </twig:ui:form-section>

            <twig:ui:form-section
                title="Warning"
                iconColor="warning"
                icon="heroicons:exclamation-triangle"
            >
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">Warning colored icon</p>
                </twig:block>
            </twig:ui:form-section>

            <twig:ui:form-section
                title="Danger"
                iconColor="danger"
                icon="heroicons:exclamation-circle"
            >
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">Danger colored icon</p>
                </twig:block>
            </twig:ui:form-section>
        </div>
        TWIG);
    }

    #[Story('Collapsible', order: 4)]
    public function collapsible(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <twig:ui:form-section title="Expanded Section" collapsible>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This section starts expanded. Click the header to collapse.</p>
                </twig:block>
            </twig:ui:form-section>

            <twig:ui:form-section title="Collapsed Section" collapsible collapsed>
                <twig:block name="content">
                    <p class="text-gray-600 dark:text-gray-400">This section starts collapsed. Click the header to expand.</p>
                </twig:block>
            </twig:ui:form-section>
        </div>
        TWIG);
    }

    #[Story('With Footer', order: 5)]
    public function withFooter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form-section title="Profile Settings">
            <twig:block name="content">
                <div class="space-y-4">
                    <twig:ui:input-group label="Display Name">
                        <twig:ui:input name="display_name" placeholder="Your display name" />
                    </twig:ui:input-group>
                    <twig:ui:input-group label="Bio">
                        <twig:ui:input:textarea name="bio" placeholder="Tell us about yourself" />
                    </twig:ui:input-group>
                </div>
            </twig:block>
            <twig:block name="footer">
                <div class="flex justify-end gap-2">
                    <twig:ui:button variant="outline" size="sm">Reset</twig:ui:button>
                    <twig:ui:button variant="primary" size="sm">Save Section</twig:ui:button>
                </div>
            </twig:block>
        </twig:ui:form-section>
        TWIG);
    }

    #[Story('Without Border', order: 6)]
    public function withoutBorder(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form-section title="Borderless Section" :bordered="false">
            <twig:block name="content">
                <p class="text-gray-600 dark:text-gray-400">This section has no border or shadow.</p>
            </twig:block>
        </twig:ui:form-section>
        TWIG);
    }

    #[Story('With Header Actions', order: 7)]
    public function withHeaderActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form-section title="Notifications" subtitle="Manage your notification preferences">
            <twig:block name="header_actions">
                <twig:ui:button variant="ghost" size="sm">Reset All</twig:ui:button>
            </twig:block>
            <twig:block name="content">
                <div class="space-y-3">
                    <label class="flex items-center gap-3">
                        <twig:ui:switch name="email_notifications" />
                        <span class="text-sm text-gray-700 dark:text-gray-300">Email notifications</span>
                    </label>
                    <label class="flex items-center gap-3">
                        <twig:ui:switch name="push_notifications" />
                        <span class="text-sm text-gray-700 dark:text-gray-300">Push notifications</span>
                    </label>
                </div>
            </twig:block>
        </twig:ui:form-section>
        TWIG);
    }
}
