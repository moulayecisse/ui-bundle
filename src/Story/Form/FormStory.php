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
    name: 'form',
    category: 'form',
    label: 'Form',
    description: 'Complete form wrapper with header, content grid, and footer'
)]
class FormStory extends AbstractComponentStory
{
    #[Prop(type: 'FormView | null', default: 'null')]
    public string $form = 'Symfony form object';

    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form name attribute';

    #[Prop(type: 'string | null', default: 'null')]
    public string $method = 'Form method (GET, POST)';

    #[Prop(type: 'string | null', default: 'null')]
    public string $action = 'Form action URL';

    #[Prop(type: 'string | null', default: 'null')]
    public string $enctype = 'Form enctype';

    #[Prop(type: 'string | null', default: 'null')]
    public string $title = 'Form header title';

    #[Prop(type: 'string | null', default: 'null')]
    public string $description = 'Form header description';

    #[Prop(type: "'vertical' | 'horizontal'", default: "'vertical'")]
    public string $layout = 'Field layout direction';

    #[Prop(type: 'number', default: '12')]
    public string $cols = 'Grid columns';

    #[Prop(type: 'number', default: '6')]
    public string $gap = 'Grid gap';

    #[Prop(type: 'boolean', default: 'false')]
    public string $divide = 'Add dividers between rows';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[NestedAttribute]
    public string $header = 'Attributes passed to the header section';

    #[NestedAttribute]
    public string $footer = 'Footer attributes (footer:show, footer:class)';

    #[NestedAttribute]
    public string $submit = 'Submit button attributes (submit:label, submit:class)';

    #[NestedAttribute]
    public string $cancel = 'Cancel button attributes (cancel:label, cancel:class)';

    #[Slot]
    public string $headerSlot = 'Custom header content';

    #[Slot]
    public string $content = 'Form fields content (default block)';

    #[Slot]
    public string $footerSlot = 'Custom footer content';

    #[Story('Basic Form', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form action="#" method="POST" class="max-w-lg" title="Contact Us" description="Send us a message and we'll get back to you.">
            <twig:ui:input-group name="name" label:text="Name" input:placeholder="John Doe" />
            <twig:ui:input-group name="email" type="email" label:text="Email" input:placeholder="john@example.com" />
            <twig:ui:input-group name="message" type="textarea" label:text="Message" :col="12" input:placeholder="Your message..." />
        </twig:ui:form>
        TWIG);
    }

    #[Story('Custom Button Labels', order: 1)]
    public function customButtons(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form action="#" class="max-w-lg" title="Settings" submit:label="Save Changes" cancel:label="Discard">
            <twig:ui:input-group name="siteName" label:text="Site Name" input:placeholder="My Website" />
            <twig:ui:input-group name="timezone" label:text="Timezone" input:placeholder="UTC" />
            <twig:ui:input-group name="notifications" type="checkbox" label:text="Enable notifications" />
        </twig:ui:form>
        TWIG);
    }

    #[Story('Login Form', order: 2)]
    public function loginForm(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form action="#" class="max-w-md" title="Bienvenue" description="Connectez-vous à votre compte." submit:label="Connexion" submit:class="w-full" footer:class="block">
            <twig:ui:input-group name="email" type="email" label:text="Email" :col="12" input:placeholder="vous@exemple.com" input:required />
            <twig:ui:input-group name="password" type="password" label:text="Mot de passe" :col="12" input:required />
            <twig:ui:input-group name="remember" type="checkbox" label:text="Se souvenir de moi" :col="12" />
        </twig:ui:form>
        TWIG);
    }

    #[Story('Horizontal Layout', order: 3)]
    public function horizontalLayout(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form action="#" class="max-w-2xl" layout="horizontal" title="Profile Settings">
            <twig:ui:input-group name="username" label:text="Username" :col="12" input:placeholder="johndoe" />
            <twig:ui:input-group name="email" type="email" label:text="Email" :col="12" input:placeholder="john@example.com" />
            <twig:ui:input-group name="bio" type="textarea" label:text="Bio" :col="12" input:placeholder="Tell us about yourself..." />
        </twig:ui:form>
        TWIG);
    }

    #[Story('With Footer', order: 4)]
    public function withFooter(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:form action="#" class="max-w-lg" title="Quick Search" footer:show submit:label="Search">
            <twig:ui:input-group name="query" type="search" label:text="Search" :col="12" input:placeholder="Search..." />
        </twig:ui:form>
        TWIG);
    }

    #[Story('Form Actions Component', order: 5)]
    public function formActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4 max-w-lg">
            <p class="text-sm text-gray-500 dark:text-gray-400">Right aligned (default)</p>
            <twig:ui:form-actions>
                <twig:ui:button variant="ghost">Cancel</twig:ui:button>
                <twig:ui:button>Submit</twig:ui:button>
            </twig:ui:form-actions>
            <p class="text-sm text-gray-500 dark:text-gray-400">Space between</p>
            <twig:ui:form-actions class="justify-between">
                <twig:ui:button variant="ghost" class="text-red-600">Delete</twig:ui:button>
                <div class="flex gap-3">
                    <twig:ui:button variant="ghost">Cancel</twig:ui:button>
                    <twig:ui:button>Save</twig:ui:button>
                </div>
            </twig:ui:form-actions>
        </div>
        TWIG);
    }
}
