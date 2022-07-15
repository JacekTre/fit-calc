<?php

namespace App\Diet\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity (repositoryClass="App\Diet\Domain\Repository\ProductRepositoryInterface")
 * @ORM\Table (name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(name="uuid", unique=true, type="uuid", nullable=false)
     */
    private string $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="kcal", type="integer", nullable=false)
     */
    private int $kcal;

    /**
     * @ORM\Column(name="proteins", type="float", precision=10, scale=2, nullable=false)
     */
    private float $proteins;

    /**
     * @ORM\Column(name="carbs", type="float", precision=10, scale=2, nullable=false)
     */
    private float $carbs;

    /**
     * @ORM\Column(name="fat", type="float", precision=10, scale=2, nullable=false)
     */
    private float $fat;

    public function __construct(
        string $name,
        int $kcal,
        float $proteins,
        float $carbs,
        float $fat
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->kcal = $kcal;
        $this->proteins = $proteins;
        $this->carbs = $carbs;
        $this->fat = $fat;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getKcal(): int
    {
        return $this->kcal;
    }

    public function setKcal(int $kcal): void
    {
        $this->kcal = $kcal;
    }

    public function getProteins(): float
    {
        return $this->proteins;
    }

    public function setProteins(float $proteins): void
    {
        $this->proteins = $proteins;
    }

    public function getCarbs(): float
    {
        return $this->carbs;
    }

    public function setCarbs(float $carbs): void
    {
        $this->carbs = $carbs;
    }

    public function getFat(): float
    {
        return $this->fat;
    }

    public function setFat(float $fat): void
    {
        $this->fat = $fat;
    }
}