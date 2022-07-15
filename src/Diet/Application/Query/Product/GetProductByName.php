<?php

namespace App\Diet\Application\Query\Product;

class GetProductByName
{
    private string $name;

    public function __construct(
        string $name,
    ) {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}