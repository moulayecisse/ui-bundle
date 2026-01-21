<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'rating',
    category: 'form',
    label: 'Rating',
    description: 'Star-based rating input component'
)]
class RatingStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name for submission.';

    #[Prop(type: 'number', default: '0')]
    public string $value = 'Current rating value.';

    #[Prop(type: 'number', default: '5')]
    public string $max = 'Maximum rating value (number of stars).';

    #[Prop(type: 'boolean', default: 'false')]
    public string $allowHalf = 'Allow half-star ratings.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $readonly = 'Display only, no interaction.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the rating input.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Star icon size.';

    #[Prop(type: 'string', default: "'heroicons:star-solid'")]
    public string $filledIcon = 'Icon for filled stars.';

    #[Prop(type: 'string', default: "'heroicons:star'")]
    public string $emptyIcon = 'Icon for empty stars.';

    #[Prop(type: 'string', default: "'text-yellow-400'")]
    public string $color = 'Color class for filled stars.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $showValue = 'Show numeric value next to stars.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Rating', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:rating name="basic" value="3" />
        TWIG);
    }

    #[Story('With Value Display', order: 1)]
    public function withValue(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:rating name="display" value="4" showValue />
        TWIG);
    }

    #[Story('Half Stars', order: 2)]
    public function halfStars(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:rating name="half" value="3.5" allowHalf showValue />
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-16">Small</span>
                <twig:ui:rating name="sm" value="4" size="sm" />
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-16">Medium</span>
                <twig:ui:rating name="md" value="4" size="md" />
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 w-16">Large</span>
                <twig:ui:rating name="lg" value="4" size="lg" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Custom Max (10)', order: 4)]
    public function customMax(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:rating name="max10" value="7" max="10" showValue />
        TWIG);
    }

    #[Story('Readonly', order: 5)]
    public function readonly(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:rating value="4.5" allowHalf readonly showValue />
        TWIG);
    }

    #[Story('Disabled', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:rating name="disabled" value="2" disabled />
        TWIG);
    }
}
