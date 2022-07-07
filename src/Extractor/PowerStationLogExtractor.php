<?php

namespace App\Extractor;

use App\Document\PowerStationLog;

class PowerStationLogExtractor
{
    public static function extract(PowerStationLog $powerStationLog): array
    {
        return [
            'id' => $powerStationLog->getId(),
            'powerStationId' => $powerStationLog->getPowerStationId(),
            'currentPower' => $powerStationLog->getCurrentPower(),
            'measurementTime' => $powerStationLog->getMeasurementTimeAsString()
        ];
    }
}