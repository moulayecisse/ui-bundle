<?php

namespace Cisse\Bundle\Ui\Story\Type;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'number-type',
    category: 'type',
    label: 'Number Type',
    description: 'Format and display numbers with various formatting options'
)]
class NumberTypeStory extends AbstractComponentStory
{
    #[Prop(type: 'number|string', default: '0')]
    public string $value = 'Number value to display.';

    #[Prop(type: 'int', default: '0')]
    public string $decimals = 'Number of decimal places.';

    #[Prop(type: "'number'|'currency'|'percent'", default: "'number'")]
    public string $format = 'Number format type.';

    #[Prop(type: 'string', default: "'USD'")]
    public string $currency = 'Currency code for currency format.';

    #[Prop(type: 'string', default: "''")]
    public string $prefix = 'Text to prepend to the number.';

    #[Prop(type: 'string', default: "''")]
    public string $suffix = 'Text to append to the number.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic Number', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:number value="1234567" />
        TWIG);
    }

    #[Story('With Decimals', order: 1)]
    public function decimals(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:number value="1234.5678" decimals="2" />
        TWIG);
    }

    #[Story('Currency Format', order: 2)]
    public function currency(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:number value="1234.50" format="currency" currency="USD" />
        TWIG);
    }

    #[Story('Percentage', order: 3)]
    public function percentage(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:type:number value="0.8567" format="percent" />
        TWIG);
    }

    #[Story('With Prefix/Suffix', order: 4)]
    public function affixes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-2">
            <div><twig:ui:type:number value="100" prefix="$" /></div>
            <div><twig:ui:type:number value="50" suffix="%" /></div>
            <div><twig:ui:type:number value="25" suffix=" items" /></div>
        </div>
        TWIG);
    }
}
