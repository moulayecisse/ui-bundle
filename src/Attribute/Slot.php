<?php

namespace Cisse\Bundle\Ui\Attribute;

/**
 * Defines a component slot/block for documentation.
 * Apply to class properties where the property value is the description.
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Slot
{
    public function __construct() {}
}
