<?php

namespace Cisse\Bundle\Ui\Model;

class Route
{
    public function __construct(
        public string $name,
        public array  $params = [],
    )
    {
    }
}
