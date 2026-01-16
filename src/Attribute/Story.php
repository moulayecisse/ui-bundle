<?php

namespace Cisse\Bundle\Ui\Attribute;

/**
 * Marks a method as a story example.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class Story
{
    public function __construct(
        public string $title,
        public int $order = 0,
    ) {}
}
