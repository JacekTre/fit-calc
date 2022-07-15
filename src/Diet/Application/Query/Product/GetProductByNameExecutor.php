<?php

namespace App\Diet\Application\Query\Product;

use App\Diet\Infrastructure\Repository\ProductRepository;

class GetProductByNameExecutor
{
    private ProductRepository $products;

    public function __construct(
        ProductRepository $products
    ) {
        $this->products = $products;
    }

    public function execute(GetProductByName $product): ProductView
    {
        return $this->products->getByName($product->getName());
    }
}