<?php

namespace App\Diet\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table (name="daily_usage")
 */
class DailyUsage
{
    /**
     * @ORM\Id
     * @ORM\Column(name="uuid", unique=true, type="uuid", nullable=false)
     */
    private string $id;

    /**
     * @ORM\ManyToOne  (targetEntity="Day", inversedBy="dailyUsage")
     * @ORM\JoinColumn (name="day_id", referencedColumnName="uuid", nullable=false)
     */
    private Day $day;

    /**
     * @ORM\ManyToOne (targetEntity="Product", fetch="EAGER")
     * @ORM\JoinColumn (name="product_id", referencedColumnName="uuid", nullable=false)
     */
    private Product $product;

    /**
     * @ORM\Column(name="usage", type="integer", nullable=false)
     */
    private float $proteins;

    public function __construct(
        Day $day,
        Product $product
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->day = $day;
        $this->product = $product;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getDay(): Day
    {
        return $this->day;
    }

    public function setDay(Day $day): void
    {
        $this->day = $day;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getProteins(): float
    {
        return $this->proteins;
    }

    public function setProteins(float $proteins): void
    {
        $this->proteins = $proteins;
    }

}