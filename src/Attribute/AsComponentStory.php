<?php

namespace Cisse\Bundle\Ui\Attribute;

/**
 * Marks a class as a component story provider.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class AsComponentStory
{
    public function __construct(
        public string $name,
        public string $category,
        public string $label,
        public string $description = '',
    ) {}
}
