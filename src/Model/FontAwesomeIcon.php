<?php

namespace Cisse\Bundle\Ui\Model;

class FontAwesomeIcon extends Icon
{
    public function __construct(
        public string|null $name,
        public string|null $category = 'fa',
    )
    {
        parent::__construct('fa', $category, $name);
    }

    public function __toString(): string
    {
        return sprintf('%s %s-%s', $this->type, $this->category, $this->name);
    }
}
