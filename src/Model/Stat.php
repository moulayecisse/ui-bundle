<?php

declare(strict_types=1);

namespace Cisse\Bundle\Ui\Model;

/**
 * Collection of StatItem objects with display configuration.
 *
 * @implements \IteratorAggregate<int, StatItem>
 */
class Stat implements \IteratorAggregate, \Countable
{
    /** @var StatItem[] */
    private array $items = [];

    /**
     * @param StatItem[] $items
     * @param int|null $cols Number of columns (1-6, null for auto)
     * @param string $gap Gap size: 'none', 'xs', 'sm', 'md', 'lg', 'xl'
     * @param string $size Stat size: 'xs', 'sm', 'md', 'lg', 'xl'
     * @param string $variant Card variant: 'default', 'outline', 'flat', 'glass'
     * @param string $iconPosition Icon position: 'top', 'bottom', 'left', 'right'
     * @param string $iconColor Default icon color: 'primary', 'secondary', 'success', 'warning', 'danger', 'info'
     * @param string $iconRounded Icon rounding: 'none', 'sm', 'md', 'lg', 'xl', 'full'
     * @param bool $hideIconBg Hide icon background
     * @param bool $labelFirst Show label before value
     * @param bool $hideTrendIcon Hide trend icons
     * @param bool $invertTrendColors Invert trend colors
     * @param bool $cardCompact Compact card padding
     * @param bool $cardClickable Add hover effects
     * @param bool $cardCentered Center content
     */
    public function __construct(
        array $items = [],
        public ?int $cols = null,
        public string $gap = 'md',
        public string $size = 'md',
        public string $variant = 'default',
        public string $iconPosition = 'top',
        public string $iconColor = 'primary',
        public string $iconRounded = 'xl',
        public bool $hideIconBg = false,
        public bool $labelFirst = false,
        public bool $hideTrendIcon = false,
        public bool $invertTrendColors = false,
        public bool $cardCompact = false,
        public bool $cardClickable = false,
        public bool $cardCentered = false,
    ) {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function add(StatItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return StatItem[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * @return \ArrayIterator<int, StatItem>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Create from an array of arrays.
     *
     * @param array{
     *     items?: array<array<string, mixed>>,
     *     cols?: int|null,
     *     gap?: string,
     *     size?: string,
     *     variant?: string,
     *     iconPosition?: string,
     *     iconColor?: string,
     *     iconRounded?: string,
     *     hideIconBg?: bool,
     *     labelFirst?: bool,
     *     hideTrendIcon?: bool,
     *     invertTrendColors?: bool,
     *     cardCompact?: bool,
     *     cardClickable?: bool,
     *     cardCentered?: bool,
     * } $data
     */
    public static function fromArray(array $data): self
    {
        $items = array_map(
            fn (array $item) => StatItem::fromArray($item),
            $data['items'] ?? $data
        );

        return new self(
            items: $items,
            cols: $data['cols'] ?? null,
            gap: $data['gap'] ?? 'md',
            size: $data['size'] ?? 'md',
            variant: $data['variant'] ?? 'default',
            iconPosition: $data['iconPosition'] ?? 'top',
            iconColor: $data['iconColor'] ?? 'primary',
            iconRounded: $data['iconRounded'] ?? 'xl',
            hideIconBg: $data['hideIconBg'] ?? false,
            labelFirst: $data['labelFirst'] ?? false,
            hideTrendIcon: $data['hideTrendIcon'] ?? false,
            invertTrendColors: $data['invertTrendColors'] ?? false,
            cardCompact: $data['cardCompact'] ?? false,
            cardClickable: $data['cardClickable'] ?? false,
            cardCentered: $data['cardCentered'] ?? false,
        );
    }

    /**
     * Convert to array for template rendering.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'items' => array_map(
                fn (StatItem $item) => $item->toArray(),
                $this->items
            ),
            'cols' => $this->cols,
            'gap' => $this->gap,
            'size' => $this->size,
            'variant' => $this->variant,
            'iconPosition' => $this->iconPosition,
            'iconColor' => $this->iconColor,
            'iconRounded' => $this->iconRounded,
            'hideIconBg' => $this->hideIconBg,
            'labelFirst' => $this->labelFirst,
            'hideTrendIcon' => $this->hideTrendIcon,
            'invertTrendColors' => $this->invertTrendColors,
            'cardCompact' => $this->cardCompact,
            'cardClickable' => $this->cardClickable,
            'cardCentered' => $this->cardCentered,
        ];
    }
}
