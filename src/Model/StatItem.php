<?php

declare(strict_types=1);

namespace Cisse\Bundle\Ui\Model;

/**
 * Represents a single statistic item.
 */
class StatItem
{
    public function __construct(
        public string $label,
        public int|float|string $value,
        public string|Icon|null $icon = null,
        public ?string $description = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public int|float|null $change = null,
        public ?string $changeLabel = null,
        public ?string $trend = null,
        public ?string $color = null,
    ) {}

    /**
     * Create a StatItem from an array.
     *
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $icon = $data['icon'] ?? null;
        if (is_string($icon)) {
            $icon = UxIcon::fromString($icon);
        }

        return new self(
            label: $data['label'] ?? '',
            value: $data['value'] ?? 0,
            icon: $icon,
            description: $data['description'] ?? null,
            prefix: $data['prefix'] ?? null,
            suffix: $data['suffix'] ?? null,
            change: $data['change'] ?? null,
            changeLabel: $data['changeLabel'] ?? null,
            trend: $data['trend'] ?? null,
            color: $data['color'] ?? null,
        );
    }

    /**
     * Get the icon as string for template rendering.
     */
    public function getIconString(): ?string
    {
        if ($this->icon === null) {
            return null;
        }

        return (string) $this->icon;
    }

    /**
     * Convert to array for template rendering.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'label' => $this->label,
            'value' => $this->value,
            'icon' => $this->getIconString(),
            'description' => $this->description,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'change' => $this->change,
            'changeLabel' => $this->changeLabel,
            'trend' => $this->trend,
            'color' => $this->color,
        ], fn ($v) => $v !== null);
    }
}
