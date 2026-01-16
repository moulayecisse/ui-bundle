<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'tags-input',
    category: 'form',
    label: 'Tags Input',
    description: 'Input for managing a list of tags with add/remove functionality'
)]
class TagsInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name';

    #[Prop(type: 'array', default: '[]')]
    public string $value = 'Initial tags array';

    #[Prop(type: 'string', default: "'Add tag...'")]
    public string $placeholder = 'Input placeholder';

    #[Prop(type: 'number | null', default: 'null')]
    public string $max = 'Maximum number of tags';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Input size';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic Tags Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:tags-input name="tags" placeholder="Add tag..." />
        </div>
        TWIG);
    }

    #[Story('With Initial Values', order: 1)]
    public function initialValues(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:tags-input
                name="skills"
                :value="['JavaScript', 'TypeScript', 'Vue.js']"
            />
        </div>
        TWIG);
    }

    #[Story('With Max Tags (5)', order: 2)]
    public function maxTags(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:tags-input
                name="limited"
                :value="['Tag 1', 'Tag 2']"
                :max="5"
                placeholder="Max 5 tags..."
            />
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 3)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md space-y-4">
            <twig:ui:tags-input name="sm" size="sm" :value="['Small']" placeholder="Small..." />
            <twig:ui:tags-input name="md" size="md" :value="['Medium']" placeholder="Medium..." />
            <twig:ui:tags-input name="lg" size="lg" :value="['Large']" placeholder="Large..." />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 4)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md">
            <twig:ui:tags-input
                name="disabled"
                :value="['Readonly', 'Tags']"
                disabled
            />
        </div>
        TWIG);
    }
}
