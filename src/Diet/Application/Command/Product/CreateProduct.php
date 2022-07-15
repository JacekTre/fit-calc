<?php

namespace App\Diet\Application\Command\Product;


class CreateProduct
{
    private string $name;

    private int $kcal;

    private float $proteins;

    private float $fat;

    private float $carbs;

    public function __construct(
        string $name,
        int $kcal,
        float $proteins,
        float $fat,
        float $carbs
    ) {
        $this->name = $name;
        $this->kcal = $kcal;
        $this->proteins = $proteins;
        $this->fat = $fat;
        $this->carbs = $carbs;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKcal(): int
    {
        return $this->kcal;
    }

    public function getProteins(): float
    {
        return $this->proteins;
    }

    public function getFat(): float
    {
        return $this->fat;
    }

    public function getCarbs(): float
    {
        return $this->carbs;
    }
}