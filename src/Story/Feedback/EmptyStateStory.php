<?php

namespace Cisse\Bundle\Ui\Story\Feedback;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'empty-state',
    category: 'feedback',
    label: 'Empty State',
    description: 'Placeholder for empty data states with call-to-action'
)]
class EmptyStateStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "'lucide:inbox'")]
    public string $icon = 'Icon name (Iconify)';

    #[Prop(type: 'string | null', default: 'null')]
    public string $title = 'Title text';

    #[Prop(type: 'string', default: "'No results found'")]
    public string $message = 'Description message';

    #[Prop(type: "'sm' | 'md' | 'lg' | 'xl'", default: "'md'")]
    public string $size = 'Empty state size';

    #[Prop(type: "'default' | 'card' | 'dashed'", default: "'default'")]
    public string $variant = 'Visual style variant';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $iconSlot = 'Custom icon content';

    #[Slot]
    public string $titleSlot = 'Title content (alternative to title prop)';

    #[Slot]
    public string $messageSlot = 'Message content (alternative to message prop)';

    #[Slot]
    public string $action = 'Primary action button';

    #[Slot]
    public string $secondaryAction = 'Secondary action button';

    #[Story('Basic Empty State', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            icon="lucide:inbox"
            title="No messages"
            message="You don't have any messages yet. Start a conversation!"
        >
            <twig:ui:button color="primary" icon="lucide:plus">New Message</twig:ui:button>
        </twig:ui:empty-state>
        TWIG);
    }

    #[Story('Search Empty State', order: 1)]
    public function search(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            icon="lucide:search"
            title="No results found"
            message="We couldn't find anything matching your search. Try different keywords."
        >
            <twig:ui:button variant="outline" color="neutral">Clear Search</twig:ui:button>
        </twig:ui:empty-state>
        TWIG);
    }

    #[Story('Error State', order: 2)]
    public function error(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            icon="lucide:alert-circle"
            title="Something went wrong"
            message="We encountered an error while loading your data. Please try again."
        >
            <twig:ui:button color="primary">Try Again</twig:ui:button>
        </twig:ui:empty-state>
        TWIG);
    }

    #[Story('Card Variant', order: 3)]
    public function card(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            variant="card"
            icon="lucide:folder"
            title="No files"
            message="Upload your first file to get started."
        >
            <twig:ui:button color="primary" icon="lucide:upload">Upload File</twig:ui:button>
        </twig:ui:empty-state>
        TWIG);
    }

    #[Story('Dashed Variant', order: 4)]
    public function dashed(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            variant="dashed"
            icon="lucide:image"
            title="No images"
            message="Drag and drop images here or click to browse."
        >
            <twig:ui:button variant="outline" color="primary" icon="lucide:plus">Add Images</twig:ui:button>
        </twig:ui:empty-state>
        TWIG);
    }

    #[Story('Sizes', order: 5)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Small</span>
                <twig:ui:empty-state size="sm" icon="lucide:inbox" title="No items" message="Your list is empty." />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Medium (default)</span>
                <twig:ui:empty-state size="md" icon="lucide:inbox" title="No items" message="Your list is empty." />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Large</span>
                <twig:ui:empty-state size="lg" icon="lucide:inbox" title="No items" message="Your list is empty." />
            </div>
        </div>
        TWIG);
    }

    #[Story('With Multiple Actions', order: 6)]
    public function multipleActions(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            icon="lucide:users"
            title="No team members"
            message="Invite team members to collaborate on this project."
        >
            <twig:block name="action">
                <twig:ui:button color="primary" icon="lucide:user-plus">Invite Members</twig:ui:button>
            </twig:block>
            <twig:block name="secondaryAction">
                <twig:ui:button variant="ghost" color="neutral">Import from CSV</twig:ui:button>
            </twig:block>
        </twig:ui:empty-state>
        TWIG);
    }

    #[Story('Message Only (No Title)', order: 7)]
    public function messageOnly(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <twig:ui:empty-state
            size="sm"
            icon="lucide:file-text"
            message="No documents to display."
        />
        TWIG);
    }
}
