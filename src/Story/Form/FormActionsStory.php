<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'form-actions',
    category: 'form',
    label: 'Form Actions',
    description: 'Form submit and cancel buttons with loading states and alignment options'
)]
class FormActionsStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'Enregistrer'")]
    public string $submitLabel = 'Label for the submit button.';

    #[Prop(type: 'string', default: "'Annuler'")]
    public string $cancelLabel = 'Label for the cancel button.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showCancel = 'Show the cancel button.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $loading = 'Show loading state on submit button.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $loadingLabel = 'Custom label during loading (defaults to submitLabel + "...").';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the submit button.';

    #[Prop(type: "'left'|'center'|'right'|'stretch'", default: "'right'")]
    public string $align = 'Button alignment.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $stackOnMobile = 'Stack buttons vertically on mobile.';

    #[Prop(type: "'primary'|'success'|'danger'", default: "'primary'")]
    public string $submitVariant = 'Submit button color variant.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $extra = 'Additional action buttons.';

    #[Story('Default', order: 0)]
    public function default(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <twig:ui:form-actions />
        </div>
        TWIG);
    }

    #[Story('Custom Labels', order: 1)]
    public function customLabels(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <twig:ui:form-actions submitLabel="Save Changes" cancelLabel="Discard" />
        </div>
        TWIG);
    }

    #[Story('Alignment Options', order: 2)]
    public function alignment(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 mb-2">Left aligned</p>
                <twig:ui:form-actions align="left" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 mb-2">Center aligned</p>
                <twig:ui:form-actions align="center" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 mb-2">Right aligned (default)</p>
                <twig:ui:form-actions align="right" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 mb-2">Stretch</p>
                <twig:ui:form-actions align="stretch" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Submit Variants', order: 3)]
    public function submitVariants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <twig:ui:form-actions submitVariant="primary" submitLabel="Save" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <twig:ui:form-actions submitVariant="success" submitLabel="Confirm" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <twig:ui:form-actions submitVariant="danger" submitLabel="Delete" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Loading State', order: 4)]
    public function loading(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 mb-2">Default loading</p>
                <twig:ui:form-actions :loading="true" />
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                <p class="text-sm text-gray-500 mb-2">Custom loading label</p>
                <twig:ui:form-actions :loading="true" loadingLabel="Saving..." />
            </div>
        </div>
        TWIG);
    }

    #[Story('Without Cancel Button', order: 5)]
    public function withoutCancel(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <twig:ui:form-actions :showCancel="false" />
        </div>
        TWIG);
    }

    #[Story('Stacked on Mobile', order: 6)]
    public function stackedOnMobile(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <p class="text-sm text-gray-500 mb-2">Resize window to see stacking</p>
            <twig:ui:form-actions :stackOnMobile="true" />
        </div>
        TWIG);
    }

    #[Story('Disabled State', order: 7)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
            <twig:ui:form-actions :disabled="true" />
        </div>
        TWIG);
    }
}
