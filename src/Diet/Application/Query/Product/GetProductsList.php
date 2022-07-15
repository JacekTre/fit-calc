<?php

namespace App\Diet\Application\Query\Product;

class GetProductsList
{
    private int $pageSize;

    private int $page;

    public function __construct(
        int $pageSize,
        int $page
    ) {
        $this->pageSize = $pageSize;
        $this->page = $page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}