<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'select-search',
    category: 'form',
    label: 'Select Search',
    description: 'Compact search form with select dropdown, input, and submit button'
)]
class SelectSearchStory extends AbstractComponentStory
{
    #[Prop(type: 'FormView|null', default: 'null')]
    public string $form = 'Symfony form object (auto-extracts CSRF token).';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Component size.';

    #[Prop(type: 'string', default: "'get'")]
    public string $method = 'Form method.';

    #[Prop(type: 'string', default: 'null')]
    public string $action = 'Form action URL.';

    #[Prop(type: 'string', default: 'null')]
    public string $baseUrl = 'Base URL for path-based submission.';

    #[Prop(type: 'string', default: 'null')]
    public string $name = 'Form name.';

    #[Prop(type: 'array', default: '[]')]
    public string $options = 'Select options: [{value, label}] or [string].';

    #[Prop(type: 'object', default: '{}')]
    public string $placeholders = 'Dynamic placeholders: {optionValue: "placeholder"}.';

    #[Prop(type: 'string', default: "'Search...'")]
    public string $defaultPlaceholder = 'Default input placeholder.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the form.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[NestedAttribute]
    public string $select = 'Select attributes (select:name, select:value).';

    #[NestedAttribute]
    public string $input = 'Input attributes (input:name, input:value).';

    #[NestedAttribute]
    public string $submit = 'Submit button attributes (submit:label, submit:icon, submit:hideLabel).';

    #[NestedAttribute]
    public string $token = 'CSRF token attributes (token:name, token:value).';

    #[Story('Basic Usage', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:form:select-search
                :options="[
                    { value: 'name', label: 'Nom' },
                    { value: 'email', label: 'Email' },
                    { value: 'id', label: 'ID' },
                ]"
                :placeholders="{
                    name: 'Rechercher par nom...',
                    email: 'Rechercher par email...',
                    id: 'Rechercher par ID...',
                }"
                defaultPlaceholder="Rechercher..."
            />
        </div>
        TWIG);
    }

    #[Story('Animal Search', order: 1)]
    public function animalSearch(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:form:select-search
                :options="[
                    { value: 'insert', label: 'Puce/Insert' },
                    { value: 'tattoo', label: 'Tatouage' },
                ]"
                :placeholders="{
                    insert: 'Numéro de puce...',
                    tattoo: 'Numéro de tatouage...',
                }"
                select:name="type"
                input:name="identifier"
            />
        </div>
        TWIG);
    }

    #[Story('Pre-selected Value', order: 2)]
    public function preselected(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:form:select-search
                :options="[
                    { value: 'all', label: 'Tous' },
                    { value: 'active', label: 'Actifs' },
                    { value: 'inactive', label: 'Inactifs' },
                ]"
                :placeholders="{
                    all: 'Rechercher dans tous...',
                    active: 'Rechercher les actifs...',
                    inactive: 'Rechercher les inactifs...',
                }"
                select:value="active"
                input:value="test"
            />
        </div>
        TWIG);
    }

    #[Story('Different Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-4">
            <twig:ui:form:select-search
                size="sm"
                :options="[{ value: 'a', label: 'Small' }]"
                defaultPlaceholder="Small size..."
            />
            <twig:ui:form:select-search
                size="md"
                :options="[{ value: 'a', label: 'Medium' }]"
                defaultPlaceholder="Medium size (default)..."
            />
            <twig:ui:form:select-search
                size="lg"
                :options="[{ value: 'a', label: 'Large' }]"
                defaultPlaceholder="Large size..."
            />
        </div>
        TWIG);
    }

    #[Story('Icon Only Button', order: 4)]
    public function iconOnly(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:form:select-search
                :options="[
                    { value: 'name', label: 'Nom' },
                    { value: 'email', label: 'Email' },
                ]"
                submit:hideLabel
            />
        </div>
        TWIG);
    }

    #[Story('Custom Button', order: 5)]
    public function customButton(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:form:select-search
                :options="[{ value: 'all', label: 'Tous' }]"
                submit:label="Filtrer"
                submit:icon="heroicons:funnel"
            />
        </div>
        TWIG);
    }

    #[Story('Disabled State', order: 6)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:form:select-search
                :options="[{ value: 'a', label: 'Option' }]"
                :disabled="true"
                defaultPlaceholder="Disabled..."
            />
        </div>
        TWIG);
    }
}
