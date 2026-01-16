<?php

namespace Cisse\Bundle\Ui\Story;

/**
 * DTO for component slot/block metadata.
 */
final readonly class SlotDefinition
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
