<?php

namespace Cisse\Bundle\Ui\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TailwindMergeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('tailwind_merge', [$this, 'tailwindMerge']),
        ];
    }

    public function tailwindMerge(string $classes): string
    {
        // Check if the TailwindMerge class exists (from gehrisandro/tailwind-merge-php)
        if (class_exists('\TailwindMerge\TailwindMerge')) {
            $tw = \TailwindMerge\TailwindMerge::instance();
            return $tw->merge($classes);
        }

        // Fallback: simple duplicate removal and cleanup
        $classArray = array_filter(array_unique(explode(' ', $classes)));
        return implode(' ', $classArray);
    }
}
