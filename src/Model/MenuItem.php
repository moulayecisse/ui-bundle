<?php

namespace Cisse\Bundle\Ui\Model;

use Symfony\Component\Uid\Uuid;

class MenuItem
{
    public string $id;

    public function __construct(
        public string    $label,
        public Route     $route,
        public Icon|null $icon = null,
        public array     $children = [],
    )
    {
        $this->id = Uuid::v4()->toRfc4122();
    }

    public function __toString(): string
    {
        return $this->label;
    }
}
