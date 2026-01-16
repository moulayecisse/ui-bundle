<?php

namespace Cisse\Bundle\Ui\Attribute;

/**
 * Defines a nested attribute target for documentation.
 * Apply to class properties where the property value is the description.
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class NestedAttribute
{
    public function __construct() {}
}
