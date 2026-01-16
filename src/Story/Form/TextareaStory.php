<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'textarea',
    category: 'form',
    label: 'Textarea',
    description: 'Multi-line text input with character count and validation'
)]
class TextareaStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name for submission';

    #[Prop(type: 'string | null', default: 'null')]
    public string $id = 'Input element ID';

    #[Prop(type: 'string', default: "''")]
    public string $value = 'Textarea value';

    #[Prop(type: 'number', default: '3')]
    public string $rows = 'Number of visible text rows';

    #[Prop(type: 'string | null', default: 'null')]
    public string $label = 'Label text above the textarea';

    #[Prop(type: 'string | null', default: 'null')]
    public string $placeholder = 'Placeholder text';

    #[Prop(type: 'string | null', default: 'null')]
    public string $hint = 'Helper text below the textarea';

    #[Prop(type: 'string | null', default: 'null')]
    public string $error = 'Error message (replaces hint when present)';

    #[Prop(type: 'number | null', default: 'null')]
    public string $maxLength = 'Maximum character limit';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showCount = 'Show character count';

    #[Prop(type: "'none' | 'vertical' | 'horizontal' | 'both'", default: "'vertical'")]
    public string $resize = 'Resize behavior';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Text and padding size';

    #[Prop(type: 'boolean', default: 'false')]
    public string $required = 'Whether field is required';

    #[Prop(type: 'boolean', default: 'false')]
    public string $autofocus = 'Autofocus on page load';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the textarea';

    #[Prop(type: 'boolean', default: 'false')]
    public string $readonly = 'Make textarea read-only';

    #[Prop(type: 'FormView | null', default: 'null')]
    public string $form = 'Symfony form field for auto-configuration';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'Default slot for textarea content/value';

    #[Story('Basic Textarea', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea name="basic" placeholder="Enter your message..." rows="4" />
        </div>
        TWIG);
    }

    #[Story('With Label', order: 1)]
    public function withLabel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea name="message" label="Your Message" placeholder="Type your message here..." rows="4" />
        </div>
        TWIG);
    }

    #[Story('With Hint', order: 2)]
    public function withHint(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea
                name="bio"
                label="Bio"
                hint="Tell us about yourself in a few sentences."
                placeholder="Write a short bio..."
                rows="3"
            />
        </div>
        TWIG);
    }

    #[Story('With Error', order: 3)]
    public function withError(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea
                name="description"
                label="Description"
                error="Description is required and must be at least 10 characters."
                rows="3"
            />
        </div>
        TWIG);
    }

    #[Story('Character Count', order: 4)]
    public function characterCount(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:input:textarea
                name="limited"
                label="Limited Input"
                :maxLength="150"
                placeholder="Maximum 150 characters..."
                rows="3"
            />
            <twig:ui:input:textarea
                name="counted"
                label="With Count Only"
                :showCount="true"
                placeholder="Character count shown below..."
                rows="3"
            />
        </div>
        TWIG);
    }

    #[Story('Size Options', order: 5)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:input:textarea name="small" size="sm" label="Small" placeholder="Small textarea" rows="2" />
            <twig:ui:input:textarea name="medium" size="md" label="Medium (default)" placeholder="Medium textarea" rows="2" />
            <twig:ui:input:textarea name="large" size="lg" label="Large" placeholder="Large textarea" rows="2" />
        </div>
        TWIG);
    }

    #[Story('Resize Options', order: 6)]
    public function resizeOptions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:input:textarea name="resize_none" resize="none" label="No Resize" placeholder="Cannot be resized" rows="2" />
            <twig:ui:input:textarea name="resize_vertical" resize="vertical" label="Vertical (default)" placeholder="Resize vertically" rows="2" />
            <twig:ui:input:textarea name="resize_horizontal" resize="horizontal" label="Horizontal" placeholder="Resize horizontally" rows="2" />
            <twig:ui:input:textarea name="resize_both" resize="both" label="Both" placeholder="Resize in any direction" rows="2" />
        </div>
        TWIG);
    }

    #[Story('Different Rows', order: 7)]
    public function differentRows(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:input:textarea name="rows2" rows="2" label="2 Rows" placeholder="Two visible rows" />
            <twig:ui:input:textarea name="rows4" rows="4" label="4 Rows" placeholder="Four visible rows" />
            <twig:ui:input:textarea name="rows6" rows="6" label="6 Rows" placeholder="Six visible rows" />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 8)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea name="disabled" label="Disabled Textarea" disabled rows="3">This content cannot be edited.</twig:ui:input:textarea>
        </div>
        TWIG);
    }

    #[Story('Required', order: 9)]
    public function required(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea name="required" label="Required Field" required rows="3" placeholder="This field is required" />
        </div>
        TWIG);
    }

    #[Story('Complete Example', order: 10)]
    public function complete(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:input:textarea
                name="feedback"
                label="Feedback"
                placeholder="Share your thoughts..."
                hint="Your feedback helps us improve."
                :maxLength="500"
                rows="5"
                required
            />
        </div>
        TWIG);
    }
}
