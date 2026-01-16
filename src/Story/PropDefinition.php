<?php

namespace Cisse\Bundle\Ui\Story;

/**
 * DTO for component prop metadata.
 */
final readonly class PropDefinition
{
    public function __construct(
        public string $name,
        public string $type,
        public string $default,
        public string $description,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'default' => $this->default,
            'description' => $this->description,
        ];
    }
}
