<?php

namespace App\Extractor;

use App\Document\PowerStationLog;
use App\Document\PowerStationReport;

class PowerStationReportExtractor
{
    public static function extract(PowerStationReport $report): array
    {
        return [
            'id' => $report->getId(),
            'powerStationId' => $report->getPowerStationId(),
            'averagePower' => $report->getAveragePower() / 1000,
            'createdAt' => $report->getCreatedAt()?->format(PowerStationLog::DATE_TIME_FORMAT)
        ];
    }
}