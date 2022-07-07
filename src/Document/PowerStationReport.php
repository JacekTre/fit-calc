<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Repository\PowerStationReportRepository")
 */
class PowerStationReport
{
    public const DATE_TIME_FORMAT = 'm-d-Y';

    /**
     * @MongoDB\Id
     */
    private string $id;

    /**
     * @MongoDB\Field(type="date")
     */
    private \DateTime $createdAt;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $powerStationId;

    /**
     * @MongoDB\Field(type="float")
     */
    private float $averagePower;

    public function __construct(
        int $powerStationId,
        float $averagePower,
        \DateTime $createdAt
    ) {
        $this->powerStationId = $powerStationId;
        $this->averagePower = $averagePower;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPowerStationId(): int
    {
        return $this->powerStationId;
    }

    public function setPowerStationId(int $powerStationId): void
    {
        $this->powerStationId = $powerStationId;
    }

    public function getAveragePower(): float
    {
        return $this->averagePower;
    }

    public function setAveragePower(float $averagePower): void
    {
        $this->averagePower = $averagePower;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}