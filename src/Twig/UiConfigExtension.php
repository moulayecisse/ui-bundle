<?php

namespace Cisse\Bundle\Ui\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class UiConfigExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private bool $useImportmap,
    ) {
    }

    public function getGlobals(): array
    {
        return [
            'ui_bundle' => [
                'preview' => [
                    'use_importmap' => $this->useImportmap,
                ],
            ],
        ];
    }
}
