<?php

namespace App\Service;

class AveragePowerService
{
    public static function calculateAveragePower(array $logs): float
    {
        $countLog = count($logs);
        if (! $countLog > 0) {
            return 0;
        }

        $sumPower = 0;
        foreach ($logs as $log) {
            $sumPower += $log->getCurrentPower();
        }

        return $sumPower/$countLog;
    }
}