<?php

namespace App\Diet\Application\Query\Product;

use App\Diet\Infrastructure\Repository\ProductRepository;

class GetProductByIdExecutor
{
    private ProductRepository $products;

    public function __construct(
        ProductRepository $products
    ) {
        $this->products = $products;
    }

    public function execute(GetProductById $product): ProductView
    {
        return $this->products->getById($product->getId());
    }
}