<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Repository\PowerStationRepository")
 */
class PowerStation
{
    // todo: adding a collection of relationships logs

    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $powerStationId;

    public function __construct(
        int $powerStationId,
    ) {
        $this->powerStationId = $powerStationId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPowerStationId(): int
    {
        return $this->powerStationId;
    }
}