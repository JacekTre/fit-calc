<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Repository\PowerStationLogRepository")
 */
class PowerStationLog
{
    public const DATE_TIME_FORMAT = 'm-d-Y H:i:s.u';

    /**
     * @MongoDB\Id
     */
    private string $id;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $powerStationId;

    /**
     * @MongoDB\Field(type="float")
     */
    private float $currentPower;

    /**
     * @MongoDB\Field(type="date")
     */
    private \DateTime $measurementTime;

    public function __construct(
        int $powerStationId,
        float $currentPower,
        string $measurementTime
    ) {
        $this->powerStationId = $powerStationId;
        $this->currentPower = $currentPower;
        $this->measurementTime = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $measurementTime);
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

    public function getCurrentPower(): float
    {
        return $this->currentPower;
    }

    public function setCurrentPower(float $currentPower): void
    {
        $this->currentPower = $currentPower;
    }

    public function getMeasurementTime(): \DateTime
    {
        return $this->measurementTime;
    }

    public function setMeasurementTime(\DateTime $measurementTime): void
    {
        $this->measurementTime = $measurementTime;
    }

    public function getMeasurementTimeAsString(): string
    {
        return $this->measurementTime->format(self::DATE_TIME_FORMAT);
    }

    public function setMeasurementTimeFromString(string $measurementTime): void
    {
        $this->measurementTime = \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $measurementTime);
    }
}