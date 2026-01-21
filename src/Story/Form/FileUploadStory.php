<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'file-upload',
    category: 'form',
    label: 'File Upload',
    description: 'Drag and drop file upload with preview'
)]
class FileUploadStory extends AbstractComponentStory
{
    #[Prop(type: 'string|null', default: 'null')]
    public string $name = 'Form field name ([] appended if multiple).';

    #[Prop(type: 'string|null', default: 'null')]
    public string $id = 'Input element ID.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $accept = 'Accepted file types (e.g., "image/*", ".pdf").';

    #[Prop(type: 'boolean', default: 'false')]
    public string $multiple = 'Allow multiple file selection.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $maxSize = 'Maximum file size in bytes.';

    #[Prop(type: 'number|null', default: 'null')]
    public string $maxFiles = 'Maximum number of files allowed.';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disable the file upload.';

    #[Prop(type: 'string', default: "'Drop files here...'")]
    public string $label = 'Dropzone label text.';

    #[Prop(type: 'string|null', default: 'null')]
    public string $description = 'Help text below the label.';

    #[Prop(type: "'sm'|'md'|'lg'", default: "'md'")]
    public string $size = 'Dropzone size (padding, icon, text).';

    #[Prop(type: "'default'|'solid'|'minimal'", default: "'default'")]
    public string $variant = 'Dropzone visual style.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showIcon = 'Show upload icon.';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showFileList = 'Show list of selected files.';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes.';

    #[Story('Basic File Upload', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:file-upload name="file" />
        </div>
        TWIG);
    }

    #[Story('With Description', order: 1)]
    public function withDescription(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:file-upload
                name="document"
                label="Upload Document"
                description="PDF, DOC, or DOCX files only"
            />
        </div>
        TWIG);
    }

    #[Story('Multiple Files', order: 2)]
    public function multipleFiles(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:file-upload
                name="images"
                multiple
                label="Drop images here or click to upload"
                accept="image/*"
            />
        </div>
        TWIG);
    }

    #[Story('With Max Size (5MB)', order: 3)]
    public function withMaxSize(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:file-upload
                name="avatar"
                label="Upload avatar"
                accept="image/png,image/jpeg"
                :maxSize="5242880"
            />
        </div>
        TWIG);
    }

    #[Story('Size Variants', order: 4)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-6">
            <div>
                <p class="text-sm text-gray-500 mb-2">Small</p>
                <twig:ui:file-upload name="size-sm" size="sm" label="Upload file" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Medium (default)</p>
                <twig:ui:file-upload name="size-md" size="md" label="Upload file" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Large</p>
                <twig:ui:file-upload name="size-lg" size="lg" label="Upload file" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Style Variants', order: 5)]
    public function variants(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg space-y-6">
            <div>
                <p class="text-sm text-gray-500 mb-2">Default (dashed border)</p>
                <twig:ui:file-upload name="var-default" variant="default" label="Drop files here" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Solid (filled background)</p>
                <twig:ui:file-upload name="var-solid" variant="solid" label="Drop files here" />
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Minimal</p>
                <twig:ui:file-upload name="var-minimal" variant="minimal" label="Drop files here" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Without Icon', order: 6)]
    public function withoutIcon(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:file-upload name="no-icon" :showIcon="false" label="Click to upload" description="Or drag and drop files" />
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 7)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-lg">
            <twig:ui:file-upload name="disabled" disabled />
        </div>
        TWIG);
    }
}
