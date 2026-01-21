<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'button',
    category: 'core',
    label: 'Button',
    description: 'Primary action buttons with variants'
)]
class ButtonStory extends AbstractComponentStory
{
    // Props
    #[Prop(type: "'solid'|'outline'|'ghost'|'soft'", default: "'solid'")]
    public string $variant = 'Button style variant.';

    #[Prop(type: "'primary'|'secondary'|'success'|'warning'|'danger'|'info'|'neutral'|'white'|'black'", default: "'primary'")]
    public string $color = 'Button color theme.';

    #[Prop(type: "'xs'|'sm'|'md'|'lg'|'xl'", default: "'md'")]
    public string $size = 'Button size.';

    #[Prop(type: "'button'|'submit'|'reset'", default: "'button'")]
    public string $type = 'Button type attribute.';

    #[Prop(type: 'string', default: 'null')]
    public string $href = 'If provided, renders as anchor link instead of button.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $icon = 'Icon name (Iconify) shown before content.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $iconRight = 'Icon name shown after content.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $label = 'Button label text.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loading = 'Show loading spinner and disable button.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the button.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $block = 'Full width button.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $bordered = 'Add subtle border matching the color.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    // Slots
    #[Slot]
    public string $content = 'Button content (default slot).';

    // Stories
    #[Story('Solid Variant (default)', order: 0)]
    public function solid(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button>Primary</twig:ui:button>
            <twig:ui:button color="secondary">Secondary</twig:ui:button>
            <twig:ui:button color="success">Success</twig:ui:button>
            <twig:ui:button color="warning">Warning</twig:ui:button>
            <twig:ui:button color="danger">Danger</twig:ui:button>
            <twig:ui:button color="info">Info</twig:ui:button>
            <twig:ui:button color="neutral">Neutral</twig:ui:button>
            <twig:ui:button color="white">White</twig:ui:button>
            <twig:ui:button color="black">Black</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Outline Variant', order: 1)]
    public function outline(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button variant="outline">Primary</twig:ui:button>
            <twig:ui:button variant="outline" color="secondary">Secondary</twig:ui:button>
            <twig:ui:button variant="outline" color="success">Success</twig:ui:button>
            <twig:ui:button variant="outline" color="warning">Warning</twig:ui:button>
            <twig:ui:button variant="outline" color="danger">Danger</twig:ui:button>
            <twig:ui:button variant="outline" color="info">Info</twig:ui:button>
            <twig:ui:button variant="outline" color="neutral">Neutral</twig:ui:button>
            <twig:ui:button variant="outline" color="white">White</twig:ui:button>
            <twig:ui:button variant="outline" color="black">Black</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Ghost Variant', order: 2)]
    public function ghost(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button variant="ghost">Primary</twig:ui:button>
            <twig:ui:button variant="ghost" color="secondary">Secondary</twig:ui:button>
            <twig:ui:button variant="ghost" color="success">Success</twig:ui:button>
            <twig:ui:button variant="ghost" color="warning">Warning</twig:ui:button>
            <twig:ui:button variant="ghost" color="danger">Danger</twig:ui:button>
            <twig:ui:button variant="ghost" color="info">Info</twig:ui:button>
            <twig:ui:button variant="ghost" color="neutral">Neutral</twig:ui:button>
            <twig:ui:button variant="ghost" color="white">White</twig:ui:button>
            <twig:ui:button variant="ghost" color="black">Black</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Soft Variant', order: 3)]
    public function soft(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button variant="soft">Primary</twig:ui:button>
            <twig:ui:button variant="soft" color="secondary">Secondary</twig:ui:button>
            <twig:ui:button variant="soft" color="success">Success</twig:ui:button>
            <twig:ui:button variant="soft" color="warning">Warning</twig:ui:button>
            <twig:ui:button variant="soft" color="danger">Danger</twig:ui:button>
            <twig:ui:button variant="soft" color="info">Info</twig:ui:button>
            <twig:ui:button variant="soft" color="neutral">Neutral</twig:ui:button>
            <twig:ui:button variant="soft" color="white">White</twig:ui:button>
            <twig:ui:button variant="soft" color="black">Black</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap items-center gap-2">
            <twig:ui:button size="xs">Extra Small</twig:ui:button>
            <twig:ui:button size="sm">Small</twig:ui:button>
            <twig:ui:button size="md">Medium</twig:ui:button>
            <twig:ui:button size="lg">Large</twig:ui:button>
            <twig:ui:button size="xl">Extra Large</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('With Left Icon', order: 5)]
    public function withLeftIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button icon="lucide:plus">Add Item</twig:ui:button>
            <twig:ui:button icon="lucide:check" color="success">Confirm</twig:ui:button>
            <twig:ui:button icon="lucide:trash-2" color="danger">Delete</twig:ui:button>
            <twig:ui:button icon="lucide:download" variant="outline">Download</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('With Right Icon', order: 6)]
    public function withRightIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button iconRight="lucide:arrow-right">Continue</twig:ui:button>
            <twig:ui:button iconRight="lucide:external-link" variant="outline">Open Link</twig:ui:button>
            <twig:ui:button iconRight="lucide:chevron-down" variant="ghost">Expand</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Icon Only', order: 7)]
    public function iconOnly(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button icon="lucide:plus" />
            <twig:ui:button icon="lucide:pencil" variant="outline" />
            <twig:ui:button icon="lucide:trash-2" variant="ghost" color="danger" />
            <twig:ui:button icon="lucide:settings" variant="soft" />
            <twig:ui:button icon="lucide:heart" variant="soft" color="danger" />
        </div>
        TWIG);
    }

    #[Story('Loading State', order: 8)]
    public function loading(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button :loading="true">Loading...</twig:ui:button>
            <twig:ui:button :loading="true" variant="outline">Please wait</twig:ui:button>
            <twig:ui:button :loading="true" color="success">Processing</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Disabled State', order: 9)]
    public function disabledState(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button :disabled="true">Disabled Primary</twig:ui:button>
            <twig:ui:button :disabled="true" color="secondary">Disabled Secondary</twig:ui:button>
            <twig:ui:button :disabled="true" variant="outline">Disabled Outline</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Block / Full Width', order: 10)]
    public function blockWidth(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-2 max-w-md">
            <twig:ui:button :block="true">Full Width Primary</twig:ui:button>
            <twig:ui:button :block="true" variant="outline" icon="lucide:log-in">Sign In</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('As Link', order: 11)]
    public function asLink(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button href="#">Link Button</twig:ui:button>
            <twig:ui:button href="#" iconRight="lucide:external-link" variant="outline">External Link</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Button Types', order: 12)]
    public function buttonTypes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button type="button">Button</twig:ui:button>
            <twig:ui:button type="submit" color="success">Submit</twig:ui:button>
            <twig:ui:button type="reset" variant="outline">Reset</twig:ui:button>
        </div>
        TWIG);
    }

    #[Story('Bordered', order: 13)]
    public function bordered(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex flex-wrap gap-2">
            <twig:ui:button bordered>Primary</twig:ui:button>
            <twig:ui:button bordered color="secondary">Secondary</twig:ui:button>
            <twig:ui:button bordered color="success">Success</twig:ui:button>
            <twig:ui:button bordered color="warning">Warning</twig:ui:button>
            <twig:ui:button bordered color="danger">Danger</twig:ui:button>
            <twig:ui:button bordered color="white">White</twig:ui:button>
            <twig:ui:button bordered color="black">Black</twig:ui:button>
        </div>
        <div class="flex flex-wrap gap-2 mt-4">
            <twig:ui:button bordered variant="soft">Soft Primary</twig:ui:button>
            <twig:ui:button bordered variant="soft" color="success">Soft Success</twig:ui:button>
            <twig:ui:button bordered variant="ghost" color="danger">Ghost Danger</twig:ui:button>
        </div>
        TWIG);
    }
}
