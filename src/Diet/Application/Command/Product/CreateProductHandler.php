<?php

namespace App\Diet\Application\Command\Product;

use App\Diet\Domain\Model\Product;
use App\Diet\Domain\Repository\ProductRepositoryInterface;

class CreateProductHandler
{
    private ProductRepositoryInterface $products;

    public function __construct(
        ProductRepositoryInterface $products
    ) {
        $this->products = $products;
    }

    public function handle(CreateProduct $createProduct): void
    {
        $existingProduct = $this->products->getByNameORM($createProduct->getName());
        if ($existingProduct instanceof Product) {
            throw new \Exception('Product already exist');
        }

        $product = new Product(
            $createProduct->getName(),
            $createProduct->getKcal(),
            $createProduct->getProteins(),
            $createProduct->getCarbs(),
            $createProduct->getFat()
        );

        $this->products->save($product);
    }
}