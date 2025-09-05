<?php

namespace Cisse\Bundle\Ui\Model;

class UxIcon extends Icon
{
    public function __construct(
        public string|null $name,
        public string|null $category,
    )
    {
        parent::__construct('ux', $category, $name);
    }

    public function __toString(): string
    {
        return sprintf('%s:%s', $this->category, $this->name);
    }
}
