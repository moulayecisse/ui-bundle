<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'color-picker',
    category: 'form',
    label: 'Color Picker',
    description: 'Color selection with swatches and input'
)]
class ColorPickerStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name for submission';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Input element ID';

    #[Prop(type: 'string', default: "'#3b82f6'")]
    public string $value = 'Current color value (hex format)';

    #[Prop(type: 'array', default: '[20 colors]')]
    public string $swatches = 'Preset color swatches to display';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showInput = 'Show text/native color input below swatches';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showValue = 'Show hex value next to color preview';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the color picker';

    #[Prop(type: 'string | null', default: 'null')]
    public string $label = 'Label text above the picker';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Picker trigger size';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Color Picker', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:color-picker name="color" value="#3b82f6" />
        TWIG);
    }

    #[Story('With Label', order: 1)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:color-picker name="theme-color" label="Theme Color" value="#8b5cf6" />
        TWIG);
    }

    #[Story('Custom Swatches', order: 2)]
    public function customSwatches(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:color-picker
            name="brand"
            label="Brand Color"
            value="#ef4444"
            :swatches="['#ef4444', '#f97316', '#eab308', '#22c55e', '#3b82f6', '#8b5cf6']"
        />
        TWIG);
    }

    #[Story('Without Text Input', order: 3)]
    public function withoutInput(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:color-picker name="simple" value="#22c55e" :showInput="false" />
        TWIG);
    }

    #[Story('Size Variants', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="flex items-end gap-4">
            <div>
                <p class="text-xs text-gray-500 mb-2">Small</p>
                <twig:ui:color-picker name="size-sm" size="sm" value="#ef4444" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Medium</p>
                <twig:ui:color-picker name="size-md" size="md" value="#22c55e" />
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-2">Large</p>
                <twig:ui:color-picker name="size-lg" size="lg" value="#3b82f6" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Without Value Display', order: 5)]
    public function withoutValue(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:color-picker name="no-value" value="#8b5cf6" :showValue="false" />
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:color-picker name="disabled" label="Disabled" value="#64748b" disabled />
        TWIG);
    }
}
