<?php

namespace App\Diet\Application\Command\Product;

use App\Diet\Domain\Model\Product;
use App\Diet\Domain\Repository\ProductRepositoryInterface;

class UpdateProductHandler
{
    private ProductRepositoryInterface $products;

    public function __construct(
        ProductRepositoryInterface $products
    ) {
        $this->products = $products;
    }

    public function handle(UpdateProduct $updateProduct): void
    {
        $product = $this->products->getByIdORM($updateProduct->getId());
        if (! $product instanceof Product) {
            throw new \Exception('Product does not exist!');
        }

        $product->setName($updateProduct->getName());
        $product->setProteins($updateProduct->getProteins());
        $product->setCarbs($updateProduct->getCarbs());
        $product->setFat($updateProduct->getFat());

        $this->products->save($product);
    }
}