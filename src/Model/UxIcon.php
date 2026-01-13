<?php

declare(strict_types=1);

namespace Cisse\Bundle\Ui\Model;

class UxIcon extends Icon
{
    public function __construct(
        public ?string $name,
        public ?string $category = null,
    ) {
        parent::__construct('ux', $category, $name);
    }

    /**
     * Create from string format "category:name" or just "name".
     */
    public static function fromString(string $icon): self
    {
        if (str_contains($icon, ':')) {
            [$category, $name] = explode(':', $icon, 2);

            return new self($name, $category);
        }

        return new self($icon);
    }

    /**
     * Create a Lucide icon.
     */
    public static function lucide(string $name): self
    {
        return new self($name, 'lucide');
    }

    /**
     * Create a CoreUI icon.
     */
    public static function cil(string $name): self
    {
        return new self($name, 'cil');
    }

    /**
     * Create a Heroicons icon.
     */
    public static function heroicons(string $name): self
    {
        return new self($name, 'heroicons');
    }

    public function __toString(): string
    {
        if ($this->category !== null) {
            return sprintf('%s:%s', $this->category, $this->name);
        }

        return $this->name ?? '';
    }
}
