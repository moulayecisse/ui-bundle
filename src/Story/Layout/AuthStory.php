<?php

namespace Cisse\Bundle\Ui\Story\Layout;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\NestedAttribute;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Slot;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'auth',
    category: 'layout',
    label: 'Auth Layout',
    description: 'Split-screen authentication layout with branding and form panels'
)]
class AuthStory extends AbstractComponentStory
{
    #[Prop(type: 'string', default: "''")]
    public string $appName = 'Application name shown with logo';

    #[Prop(type: 'string | null', default: 'null')]
    public string $appIcon = 'Icon name (e.g., "heroicons:cube")';

    #[Prop(type: 'string', default: "'size-7 text-white'")]
    public string $appIconClass = 'CSS classes for app icon';

    #[Prop(type: 'string', default: "''")]
    public string $headline = 'Main headline text (e.g., "Welcome to")';

    #[Prop(type: 'string', default: "''")]
    public string $subHeadline = 'Sub-headline text (e.g., "MyApp Platform")';

    #[Prop(type: 'string', default: "''")]
    public string $description = 'Description text below headlines';

    #[Prop(type: 'array', default: '[]')]
    public string $features = 'List of features: { text, icon?, iconClass? } or strings';

    #[Prop(type: 'string', default: "'heroicons:check'")]
    public string $featureIcon = 'Default icon for features';

    #[Prop(type: 'string', default: "'size-5 text-white'")]
    public string $featureIconClass = 'Default CSS classes for feature icons';

    #[Prop(type: 'string', default: "'from-primary-700'")]
    public string $gradientFrom = 'Starting gradient class';

    #[Prop(type: 'string', default: "'to-primary-800'")]
    public string $gradientTo = 'Ending gradient class';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showDecorations = 'Show decorative blur circles';

    #[Prop(type: 'boolean', default: 'true')]
    public string $showPattern = 'Show dot pattern overlay';

    #[Prop(type: 'string | null', default: 'null')]
    public string $formTitle = 'Title above the form';

    #[Prop(type: 'string | null', default: 'null')]
    public string $formSubtitle = 'Subtitle above the form';

    #[Prop(type: 'string', default: "'/'")]
    public string $homeLink = 'URL for logo link';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Slot]
    public string $content = 'The login/register form content';

    #[Slot]
    public string $branding_logo = 'Custom logo for the branding panel (desktop)';

    #[Slot]
    public string $mobile_logo = 'Custom logo for mobile view';

    #[NestedAttribute]
    public string $branding = 'Customize the branding panel (left side)';

    #[NestedAttribute]
    public string $formPanel = 'Customize the form panel (right side)';

    #[NestedAttribute]
    public string $form = 'Customize the form container';

    #[NestedAttribute]
    public string $formHeader = 'Customize the form header section';

    #[NestedAttribute]
    public string $featuresAttr = 'Customize the features list container';

    #[NestedAttribute]
    public string $mobileLogo = 'Customize the mobile logo container';

    #[Story('Overview', order: 0)]
    public function overview(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-lg p-8 text-white">
            <h3 class="text-xl font-bold mb-4">Auth Layout</h3>
            <p class="mb-4">A split-screen authentication layout with a branding panel on the left and a form panel on the right.</p>
            <ul class="list-disc list-inside space-y-2 text-white/90">
                <li>Customizable branding with app name and icon</li>
                <li>Feature list display</li>
                <li>Multiple gradient color options</li>
                <li>Mobile-responsive design</li>
                <li>Form title and subtitle support</li>
            </ul>
        </div>
        TWIG);
    }

    #[Story('Layout Structure', order: 1)]
    public function structure(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
            <div class="flex h-64">
                <div class="w-1/2 bg-gradient-to-br from-primary-600 to-primary-800 p-6 text-white flex flex-col justify-center">
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="size-8 bg-white/20 rounded-lg"></div>
                            <span class="font-bold">App Name</span>
                        </div>
                        <h2 class="text-xl font-light mb-1">Welcome to</h2>
                        <h3 class="text-2xl font-bold">MyApp</h3>
                    </div>
                    <div class="space-y-2 text-sm text-white/80">
                        <div class="flex items-center gap-2">
                            <twig:ux:icon name="heroicons:check" class="size-4" />
                            <span>Feature 1</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <twig:ux:icon name="heroicons:check" class="size-4" />
                            <span>Feature 2</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 bg-gray-50 dark:bg-gray-900 p-6 flex items-center justify-center">
                    <div class="text-center">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-1">Sign In</h3>
                        <p class="text-sm text-gray-500 mb-4">Form goes here</p>
                        <div class="space-y-2">
                            <div class="h-8 bg-gray-200 dark:bg-gray-700 rounded"></div>
                            <div class="h-8 bg-gray-200 dark:bg-gray-700 rounded"></div>
                            <div class="h-8 bg-primary-500 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        TWIG);
    }

    #[Story('Color Themes', order: 2)]
    public function colors(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-gradient-to-br from-primary-700 to-primary-800 rounded-lg p-4 text-white">
                <p class="font-semibold">Primary (Default)</p>
                <code class="text-xs opacity-75">gradientFrom="from-primary-700"</code>
            </div>
            <div class="bg-gradient-to-br from-violet-700 to-purple-800 rounded-lg p-4 text-white">
                <p class="font-semibold">Violet</p>
                <code class="text-xs opacity-75">gradientFrom="from-violet-700"</code>
            </div>
            <div class="bg-gradient-to-br from-emerald-700 to-teal-800 rounded-lg p-4 text-white">
                <p class="font-semibold">Emerald</p>
                <code class="text-xs opacity-75">gradientFrom="from-emerald-700"</code>
            </div>
            <div class="bg-gradient-to-br from-rose-700 to-pink-800 rounded-lg p-4 text-white">
                <p class="font-semibold">Rose</p>
                <code class="text-xs opacity-75">gradientFrom="from-rose-700"</code>
            </div>
        </div>
        TWIG);
    }
}
