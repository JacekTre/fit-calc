<?php

namespace App\Hydrator;

use App\Document\PowerStationReport;

class CreatePowerStationReportHydrator
{
    public static function hydrate(int $powerStationId, float $averagePower, \DateTime $startHour): PowerStationReport
    {
        return new PowerStationReport(
            $powerStationId,
            $averagePower,
            $startHour,
        );
    }
}