<?php

namespace Cisse\Bundle\Ui\Model;

class Page
{
    public function __construct(
        public int    $page = 1,
        public int    $limit = 10,
        public string $url = '',
    )
    {
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }

    public function getUrl(): string
    {
        $url = $this->url;
        if (str_contains($url, '?')) {
            $url .= '&';
        } else {
            $url .= '?';
        }

        $url .= 'page=' . $this->page;
        $url .= '&limit=' . $this->limit;
        return $url;
    }
}
