<?php

namespace Cisse\Bundle\Ui\Model;

class Icon
{
    public function __construct(
        public string      $type,
        public string|null $category,
        public string|null $name,
    )
    {
    }

    public function __toString(): string
    {
        return sprintf('%s %s-%s', $this->type, $this->category, $this->name);
    }
}
