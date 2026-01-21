<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'input-group',
    category: 'form',
    label: 'Input Group',
    description: 'Form field wrapper with label, input, help text, and error message'
)]
class InputGroupStory extends AbstractComponentStory
{
    #[Prop(type: 'FormView|null', default: 'null')]
    public string $form = 'Symfony form field.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $type = 'Input type (auto-detected from form).';

    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Field name.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Field ID.';

    #[Prop(type: 'mixed', default: 'null')]
    public string $value = 'Input value.';

    #[Prop(type: "'vertical'|'horizontal'", default: "'vertical'")]
    public string $layout = 'Label/input layout.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $col = 'Column span (1-12).';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Input size.';

    #[Prop(type: "'default'|'filled'|'flushed'", default: "'default'")]
    public string $variant = 'Input variant.';

    #[Prop(type: "'none'|'sm'|'md'|'lg'|'xl'|'full'", default: "'lg'")]
    public string $rounded = 'Border radius.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[NestedAttribute]
    public string $wrapper = 'Attributes passed to the outer container.';

    #[NestedAttribute]
    public string $label = 'Label attributes (label:text, label:col, label:class).';

    #[NestedAttribute]
    public string $input = 'Input attributes (input:placeholder, input:required, input:class).';

    #[NestedAttribute]
    public string $help = 'Help text attributes (help:text, help:class).';

    #[NestedAttribute]
    public string $error = 'Error attributes (error:text, error:class).';

    #[Story('Basic (Vertical)', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-group
                name="username"
                label:text="Username"
                help:text="Choose a unique username"
                input:placeholder="Enter username"
            />
        </div>
        TWIG);
    }

    #[Story('With Error', order: 1)]
    public function withError(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-group
                name="email"
                type="email"
                label:text="Email Address"
                value="invalid-email"
                error:text="Please enter a valid email address"
            />
        </div>
        TWIG);
    }

    #[Story('Horizontal Layout', order: 2)]
    public function horizontal(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl">
            <twig:ui:input-group
                name="company"
                label:text="Company Name"
                layout="horizontal"
                input:placeholder="Enter company name"
                help:text="Your registered business name"
            />
        </div>
        TWIG);
    }

    #[Story('Custom Column Ratio (3:9)', order: 3)]
    public function customRatio(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-xl">
            <twig:ui:input-group
                name="description"
                type="textarea"
                label:text="Description"
                label:col="3"
                input:col="9"
                layout="horizontal"
                input:placeholder="Enter description..."
            />
        </div>
        TWIG);
    }

    #[Story('Grid with Column Spans', order: 4)]
    public function gridColumns(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-2xl">
            <twig:ui:input-group
                name="firstName"
                label:text="First Name"
                input:placeholder="John"
            />
            <twig:ui:input-group
                name="lastName"
                label:text="Last Name"
                input:placeholder="Doe"
            />
            <twig:ui:input-group
                name="email"
                type="email"
                label:text="Email"
                :col="12"
                input:placeholder="john@example.com"
            />
            <twig:ui:input-group
                name="city"
                label:text="City"
                :col="8"
                input:placeholder="New York"
            />
            <twig:ui:input-group
                name="zip"
                label:text="ZIP"
                :col="4"
                input:placeholder="10001"
            />
        </div>
        TWIG);
    }

    #[Story('Different Input Types', order: 5)]
    public function inputTypes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-12 gap-6 max-w-2xl">
            <twig:ui:input-group
                name="password"
                type="password"
                label:text="Password"
                help:text="Minimum 8 characters"
            />
            <twig:ui:input-group
                name="search"
                type="search"
                label:text="Search"
                input:placeholder="Search..."
            />
            <twig:ui:input-group
                name="amount"
                type="money"
                label:text="Amount"
                :col="6"
            />
            <twig:ui:input-group
                name="percentage"
                type="percent"
                label:text="Percentage"
                :col="6"
            />
        </div>
        TWIG);
    }

    #[Story('Checkbox Layout', order: 6)]
    public function checkbox(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-group
                name="terms"
                type="checkbox"
                label:text="I agree to the terms and conditions"
                help:text="You must agree before submitting"
            />
        </div>
        TWIG);
    }

    #[Story('Required Field', order: 7)]
    public function required(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-group
                name="email"
                type="email"
                label:text="Email Address"
                input:required
                input:placeholder="required@example.com"
            />
        </div>
        TWIG);
    }

    #[Story('Nested Attributes Customization', order: 8)]
    public function nestedCustomization(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:input-group
                name="custom"
                label:text="Custom Styled Field"
                help:text="With nested attributes"
                label:class="text-primary font-bold"
                help:class="text-blue-500"
                wrapper:class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg"
            />
        </div>
        TWIG);
    }
}
