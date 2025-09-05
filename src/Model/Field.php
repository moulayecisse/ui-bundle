<?php

namespace Cisse\Bundle\Ui\Model;

use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Uid\Uuid;
use function Symfony\Component\String\u;

readonly class Field
{
    public function __construct(
        private string|null $label = null,
        private string|null $name = null,
    ) {}

    public function getName(): string
    {
        if ($this->name === null) {
            if ($this->label === null) {
                return Uuid::v4()->toRfc4122();
            }

            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($this->label);

            return u($slug)->snake()->toString();
        }

        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label ?? $this->getName();
    }

    public function __toString(): string
    {
        return $this->getLabel();
    }
}
