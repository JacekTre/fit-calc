<?php

namespace App\Diet\Infrastructure\Factory;

use App\Diet\Application\Query\Product\ProductView;

class ProductViewFactory
{
    public static function create(array $data): ProductView
    {
        return new ProductView(
            $data['uuid'],
            $data['name'],
            $data['kcal'],
            $data['proteins'],
            $data['fat'],
            $data['carbs']
        );
    }
}