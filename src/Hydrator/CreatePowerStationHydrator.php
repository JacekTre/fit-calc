<?php

namespace App\Hydrator;

use App\Document\PowerStation;
use App\Document\PowerStationLog;

class CreatePowerStationHydrator
{
    public static function hydrate(int $id): PowerStation
    {
        return new PowerStation($id);
    }
}