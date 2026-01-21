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
    name: 'stepper',
    category: 'core',
    label: 'Stepper',
    description: 'Multi-step process indicator'
)]
class StepperStory extends AbstractComponentStory
{
    // Props
    #[Prop(type: 'array', default: '[]')]
    public string $steps = 'Array of step objects with title, description, icon, url properties.';

    #[Prop(type: 'integer', default: '0')]
    public string $currentStep = 'Index of the current active step.';

    #[Prop(type: "'horizontal'|'vertical'", default: "'horizontal'")]
    public string $orientation = 'Stepper layout orientation.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Size of step circles and text.';

    #[Prop(type: "'default'", default: "'default'")]
    public string $variant = 'Stepper style variant.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $clickable = 'Allow clicking on completed steps.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showNumbers = 'Show step numbers in circles.';

    #[Prop(type: "'primary'|'success'|'info'", default: "'primary'")]
    public string $color = 'Color theme for active/completed steps.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    // Slots
    #[Slot]
    public string $content = 'Nested stepper:item components (alternative to steps array).';

    // Nested Attributes
    #[NestedAttribute]
    public string $step = 'Customize individual step containers.';

    #[NestedAttribute]
    public string $circle = 'Customize step circle elements.';

    #[NestedAttribute]
    public string $line = 'Customize progress line.';

    #[NestedAttribute]
    public string $title = 'Customize step titles.';

    #[NestedAttribute]
    public string $description = 'Customize step descriptions.';

    // Stories
    #[Story('Array-based Syntax', order: 0)]
    public function arrayBased(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:stepper
            :currentStep="1"
            :steps="[
                { title: 'Account', description: 'Create your account' },
                { title: 'Profile', description: 'Set up your profile' },
                { title: 'Review', description: 'Review and submit' }
            ]"
        />
        TWIG);
    }

    #[Story('Nested Item Syntax', order: 1)]
    public function nestedItems(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:stepper>
            <twig:ui:stepper:item :step="1" title="Cart" completed />
            <twig:ui:stepper:item :step="2" title="Shipping" completed />
            <twig:ui:stepper:item :step="3" title="Payment" active />
            <twig:ui:stepper:item :step="4" title="Confirm" />
        </twig:ui:stepper>
        TWIG);
    }

    #[Story('With Icons (Array)', order: 2)]
    public function withIconsArray(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:stepper
            :currentStep="1"
            :steps="[
                { title: 'Details', icon: 'lucide:user' },
                { title: 'Address', icon: 'lucide:map-pin' },
                { title: 'Payment', icon: 'lucide:credit-card' }
            ]"
        />
        TWIG);
    }

    #[Story('With Icons (Nested)', order: 3)]
    public function withIconsNested(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:stepper>
            <twig:ui:stepper:item title="Details" icon="lucide:user" completed />
            <twig:ui:stepper:item title="Address" icon="lucide:map-pin" active />
            <twig:ui:stepper:item title="Payment" icon="lucide:credit-card" />
        </twig:ui:stepper>
        TWIG);
    }

    #[Story('Size Variants', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-8">
            <div>
                <p class="text-sm text-gray-500 mb-2">Small</p>
                <twig:ui:stepper size="sm" :currentStep="1" :steps="[{ title: 'Step 1' }, { title: 'Step 2' }, { title: 'Step 3' }]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:stepper size="md" :currentStep="1" :steps="[{ title: 'Step 1' }, { title: 'Step 2' }, { title: 'Step 3' }]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Large</p>
                <twig:ui:stepper size="lg" :currentStep="1" :steps="[{ title: 'Step 1' }, { title: 'Step 2' }, { title: 'Step 3' }]" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Color Variants', order: 5)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-8">
            <div>
                <p class="text-sm text-gray-500 mb-2">Primary (default)</p>
                <twig:ui:stepper color="primary" :currentStep="1" :steps="[{ title: 'Step 1' }, { title: 'Step 2' }, { title: 'Step 3' }]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Success</p>
                <twig:ui:stepper color="success" :currentStep="1" :steps="[{ title: 'Step 1' }, { title: 'Step 2' }, { title: 'Step 3' }]" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Info</p>
                <twig:ui:stepper color="info" :currentStep="1" :steps="[{ title: 'Step 1' }, { title: 'Step 2' }, { title: 'Step 3' }]" />
            </div>
        </div>
        TWIG);
    }
}
