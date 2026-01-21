<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'datalist',
    category: 'core',
    label: 'Data List',
    description: 'Key-value list for displaying structured data'
)]
class DatalistStory extends AbstractComponentStory
{
    #[Prop(type: 'array', default: '[]')]
    public string $items = 'Array of items with label and value properties.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'Custom datalist items using nested components.';

    #[Story('Basic Datalist', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md bg-white dark:bg-gray-800 rounded-lg p-4">
            <twig:ui:datalist :items="[
                { label: 'Name', value: 'John Doe' },
                { label: 'Email', value: 'john@example.com' },
                { label: 'Phone', value: '+1 (555) 123-4567' },
                { label: 'Location', value: 'New York, USA' }
            ]" />
        </div>
        TWIG);
    }

    #[Story('With Custom Content', order: 1)]
    public function customContent(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-md bg-white dark:bg-gray-800 rounded-lg p-4">
            <twig:ui:datalist>
                <twig:ui:datalist:item>
                    <twig:ui:datalist:label>Status</twig:ui:datalist:label>
                    <twig:ui:datalist:value>
                        <twig:ui:badge color="success">Active</twig:ui:badge>
                    </twig:ui:datalist:value>
                </twig:ui:datalist:item>
                <twig:ui:datalist:item>
                    <twig:ui:datalist:label>Role</twig:ui:datalist:label>
                    <twig:ui:datalist:value>Administrator</twig:ui:datalist:value>
                </twig:ui:datalist:item>
                <twig:ui:datalist:item>
                    <twig:ui:datalist:label>Created</twig:ui:datalist:label>
                    <twig:ui:datalist:value>January 15, 2024</twig:ui:datalist:value>
                </twig:ui:datalist:item>
            </twig:ui:datalist>
        </div>
        TWIG);
    }
}
