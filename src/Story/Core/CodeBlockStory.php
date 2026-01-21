<?php

namespace Cisse\Bundle\Ui\Story\Core;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'code-block',
    category: 'core',
    label: 'Code Block',
    description: 'Display code or JSON data with optional title and copy button'
)]
class CodeBlockStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: 'null')]
    public string $title = 'Optional header title displayed above the code.';

    #[Prop(type: 'string', default: "'json'")]
    public string $language = 'Code language for syntax highlighting.';

    #[Prop(type: 'string', default: "'12rem'")]
    public string $maxHeight = 'Maximum height with overflow scroll.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $copyable = 'Show copy to clipboard button in header.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Slot]
    public string $content = 'The code content to display.';

    #[Story('Basic JSON', order: 0)]
    public function basicJson(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:code-block title="API Response">
        {
            "status": "success",
            "data": {
                "id": 123,
                "name": "John Doe",
                "email": "john@example.com"
            }
        }
        </twig:ui:code-block>
        TWIG);
    }

    #[Story('Without Title', order: 1)]
    public function withoutTitle(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:code-block>
        {
            "message": "Hello World",
            "timestamp": "2024-01-15T10:30:00Z"
        }
        </twig:ui:code-block>
        TWIG);
    }

    #[Story('With Copy Button', order: 2)]
    public function withCopyButton(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:code-block title="Configuration" copyable>
        {
            "database": {
                "host": "localhost",
                "port": 5432,
                "name": "myapp"
            },
            "cache": {
                "driver": "redis",
                "ttl": 3600
            }
        }
        </twig:ui:code-block>
        TWIG);
    }

    #[Story('Side by Side Comparison', order: 3)]
    public function sideBySide(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:code-block title="Before">
            {
                "status": "pending",
                "count": 5
            }
            </twig:ui:code-block>
            <twig:ui:code-block title="After">
            {
                "status": "completed",
                "count": 10
            }
            </twig:ui:code-block>
        </div>
        TWIG);
    }

    #[Story('Custom Max Height', order: 4)]
    public function customMaxHeight(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:code-block title="Large Data" maxHeight="20rem">
        {
            "users": [
                { "id": 1, "name": "Alice", "role": "admin" },
                { "id": 2, "name": "Bob", "role": "editor" },
                { "id": 3, "name": "Charlie", "role": "viewer" },
                { "id": 4, "name": "Diana", "role": "editor" },
                { "id": 5, "name": "Eve", "role": "admin" },
                { "id": 6, "name": "Frank", "role": "viewer" },
                { "id": 7, "name": "Grace", "role": "editor" },
                { "id": 8, "name": "Henry", "role": "viewer" }
            ],
            "total": 8,
            "page": 1,
            "perPage": 10
        }
        </twig:ui:code-block>
        TWIG);
    }

    #[Story('Empty State', order: 5)]
    public function emptyState(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <twig:ui:code-block title="With Data">
            {
                "value": "some data"
            }
            </twig:ui:code-block>
            <div class="flex items-center justify-center h-24 rounded-lg border border-dashed border-gray-300 dark:border-gray-600">
                <span class="text-gray-400 text-sm">No data available</span>
            </div>
        </div>
        TWIG);
    }
}
