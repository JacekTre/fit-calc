<?php

namespace App\Hydrator;

use App\Document\PowerStationLog;

class CreatePowerStationLogHydrator
{
    public static function hydrate(array $data): PowerStationLog
    {
        return new PowerStationLog(
            $data['powerStationId'],
            $data['currentPower'],
            $data['measurementTime']
        );
    }
}