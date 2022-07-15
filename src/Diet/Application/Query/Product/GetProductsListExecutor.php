<?php

namespace App\Diet\Application\Query\Product;

use App\Diet\Infrastructure\Repository\ProductRepository;

class GetProductsListExecutor
{
    private ProductRepository $products;

    public function __construct(
        ProductRepository $products
    ) {
        $this->products = $products;
    }

    public function execute(GetProductsList $getProductsList): array
    {
        return $this->products->getList(
            $getProductsList->getPageSize(),
            $getProductsList->getPage()
        );
    }
}