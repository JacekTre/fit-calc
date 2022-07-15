<?php

namespace App\Diet\Domain\Model;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity (repositoryClass="App\Diet\Domain\Repository\DayRepositoryInterface")
 * @ORM\Table (name="day")
 */
class Day
{
    /**
     * @ORM\Id
     * @ORM\Column(name="uuid", unique=true, type="uuid", nullable=false)
     */
    private string $id;

    /**
     * @ORM\Column (name="transaction_date", type="datetime_immutable", nullable="true")
     */
    private ?DateTimeInterface $date;

    public const DATE_FORMAT = 'Y-m-d';

    public function __construct(
        \DateTime $date
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->date = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date->format(self::DATE_FORMAT);
    }

    public function setDate(\DateTime $dateTime): void
    {
        $this->date = $dateTime;
    }
}