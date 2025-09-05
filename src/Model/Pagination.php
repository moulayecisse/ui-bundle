<?php

namespace Cisse\Bundle\Ui\Model;

readonly class Pagination
{
    public function __construct(
        public int    $page = 1,
        public int    $limit = 10,
        public int    $total = 0,
        public int    $max = 5,
        public string $url = '',
    )
    {
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }

    public function getNextPage(): Page|null
    {
        if ($this->page >= $this->getTotalPages()) {
            return null;
        }

        return new Page($this->page + 1, $this->limit, $this->url);
    }

    public function getTotalPages(): int
    {
        return (int)ceil($this->total / $this->limit);
    }

    public function getPreviousPage(): Page|null
    {
        if ($this->page <= 1) {
            return null;
        }

        return new Page($this->page - 1, $this->limit, $this->url);
    }

    public function getFirstPage(): Page
    {
        return new Page(1, $this->limit, $this->url);
    }

    public function getLastPage(): Page
    {
        return new Page($this->getTotalPages(), $this->limit, $this->url);
    }

    public function getPages(): array
    {
        $pages = [];
        for ($i = 1; $i <= $this->getTotalPages(); $i++) {
            $pages[] = new Page($i, $this->limit, $this->url);
        }

        return $pages;
    }

    public function firstElement(): int
    {
        return ($this->page - 1) * $this->limit + 1;
    }

    public function lastElement(): int
    {
        return min($this->page * $this->limit, $this->total);
    }
}
