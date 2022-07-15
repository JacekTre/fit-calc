<?php

namespace App\Diet\Application\Query\Product;

class GetProductById
{
    private string $id;

    public function __construct(
        string $id,
    ) {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}