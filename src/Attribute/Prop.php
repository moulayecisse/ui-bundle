<?php

namespace Cisse\Bundle\Ui\Attribute;

/**
 * Defines a component prop for documentation.
 * Apply to class properties where the property value is the description.
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Prop
{
    public function __construct(
        public string $type = 'string',
        public string $default = "''",
    ) {}
}
