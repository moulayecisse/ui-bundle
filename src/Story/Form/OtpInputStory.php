<?php

namespace Cisse\Bundle\Ui\Story\Form;

use Cisse\Bundle\Ui\Attribute\AsComponentStory;
use Cisse\Bundle\Ui\Attribute\Prop;
use Cisse\Bundle\Ui\Attribute\Story;
use Cisse\Bundle\Ui\Story\AbstractComponentStory;
use Cisse\Bundle\Ui\Story\StoryExample;

#[AsComponentStory(
    name: 'otp-input',
    category: 'form',
    label: 'OTP Input',
    description: 'One-time password input with auto-advance'
)]
class OtpInputStory extends AbstractComponentStory
{
    #[Prop(type: 'string | null', default: 'null')]
    public string $name = 'Form field name prefix';

    #[Prop(type: 'number', default: '6')]
    public string $length = 'Number of OTP digits';

    #[Prop(type: "'sm' | 'md' | 'lg'", default: "'md'")]
    public string $size = 'Input size';

    #[Prop(type: 'boolean', default: 'false')]
    public string $disabled = 'Disabled state';

    #[Prop(type: 'boolean', default: 'true')]
    public string $autoFocus = 'Auto focus first input on mount';

    #[Prop(type: 'boolean', default: 'false')]
    public string $masked = 'Mask input (show dots instead of numbers)';

    #[Prop(type: 'string', default: "''")]
    public string $class = 'Additional CSS classes';

    #[Story('Basic OTP Input', order: 0)]
    public function basic(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Enter a 6-digit code. Try typing or pasting a code like "123456".
            </p>
            <twig:ui:input:otp name="otp" :autoFocus="false" />
        </div>
        TWIG);
    }

    #[Story('Different Lengths', order: 1)]
    public function lengths(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <span class="text-xs text-gray-500 mb-2 block">4 digits</span>
                <twig:ui:input:otp name="otp-4" :length="4" :autoFocus="false" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">6 digits (default)</span>
                <twig:ui:input:otp name="otp-6" :length="6" :autoFocus="false" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">8 digits</span>
                <twig:ui:input:otp name="otp-8" :length="8" :autoFocus="false" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Sizes', order: 2)]
    public function sizes(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="space-y-6">
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Small</span>
                <twig:ui:input:otp name="otp-sm" size="sm" :length="4" :autoFocus="false" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Medium (default)</span>
                <twig:ui:input:otp name="otp-md" size="md" :length="4" :autoFocus="false" />
            </div>
            <div>
                <span class="text-xs text-gray-500 mb-2 block">Large</span>
                <twig:ui:input:otp name="otp-lg" size="lg" :length="4" :autoFocus="false" />
            </div>
        </div>
        TWIG);
    }

    #[Story('Masked (PIN mode)', order: 3)]
    public function masked(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Masked mode hides the digits for additional security (useful for PINs).
            </p>
            <twig:ui:input:otp name="otp-masked" :masked="true" :length="4" :autoFocus="false" />
        </div>
        TWIG);
    }

    #[Story('Verification Example', order: 4)]
    public function verification(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div class="max-w-sm mx-auto text-center">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-12 mx-auto text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Verify your email</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    We sent a code to your email. Enter it below to continue.
                </p>
                <div class="flex justify-center mb-6">
                    <twig:ui:input:otp name="verify-otp" :autoFocus="false" />
                </div>
                <twig:ui:button variant="primary" class="w-full">Verify</twig:ui:button>
                <p class="text-sm text-gray-500 mt-4">
                    Didn't receive the code? <a href="#" class="text-primary-500 hover:underline">Resend</a>
                </p>
            </div>
        </div>
        TWIG);
    }

    #[Story('Disabled', order: 5)]
    public function disabled(): StoryExample
    {
        return StoryExample::create()->preview(<<<'TWIG'
        <div>
            <twig:ui:input:otp name="otp-disabled" :length="4" :autoFocus="false" disabled />
        </div>
        TWIG);
    }
}
