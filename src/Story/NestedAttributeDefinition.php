<?php

namespace Cisse\Bundle\Ui\Story;

/**
 * DTO for nested attribute metadata.
 */
final readonly class NestedAttributeDefinition
{
    public function __construct(
        public string $name,
        public string $description,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
