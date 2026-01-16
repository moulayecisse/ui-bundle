<?php

namespace Cisse\Bundle\Ui\Story;

/**
 * Value object representing a single story example.
 */
final class StoryExample
{
    private function __construct(
        public readonly string $title,
        public readonly string $preview,
        public readonly string $code,
        public readonly int $order = 0,
    ) {}

    public static function create(string $title = ''): self
    {
        return new self($title, '', '', 0);
    }

    public function withTitle(string $title): self
    {
        return new self($title, $this->preview, $this->code, $this->order);
    }

    public function preview(string $preview): self
    {
        return new self($this->title, trim($preview), $this->code, $this->order);
    }

    public function code(string $code): self
    {
        return new self($this->title, $this->preview, trim($code), $this->order);
    }

    public function order(int $order): self
    {
        return new self($this->title, $this->preview, $this->code, $order);
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'preview' => $this->preview,
            'code' => $this->code ?: $this->preview, // Default to preview if code not set
            'order' => $this->order,
        ];
    }
}
