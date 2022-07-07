<?php

namespace App\Service;

use App\Document\PowerStationReport;
use App\Hydrator\CreatePowerStationReportHydrator;
use App\Repository\PowerStationLogRepository;
use App\Repository\PowerStationReportRepository;
use DateInterval;
use DatePeriod;

class GeneratorPowerStationReportService
{
    private PowerStationLogRepository $logs;

    private PowerStationReportRepository $powerStationReports;

    public function __construct(
        PowerStationLogRepository $logs,
        PowerStationReportRepository $powerStationReports
    ) {
        $this->logs = $logs;
        $this->powerStationReports = $powerStationReports;
    }

    public function generateReport(int $powerStationId, \DateTime $date): void
    {
        $start = $date;
        $end = (clone $date)->modify('+ 1 day');
        $timeRange = new DatePeriod($start, (new DateInterval('PT1H')), $end);

        foreach ($timeRange as $datetime) {
            $averagePower = AveragePowerService::calculateAveragePower(
                $this->logs->getListByPowerStationId(
                    $powerStationId,
                    $datetime,
                    (clone $datetime)->modify('+1 hour')
                )->toArray()
            );

            $report = CreatePowerStationReportHydrator::hydrate($powerStationId, $averagePower, $datetime);
            $this->powerStationReports->save($report);
        }
    }

    public function getReportDate(): \DateTime
    {
        $report = $this->powerStationReports->getLastReport();
        if ($report instanceof PowerStationReport) {
            return $report->getCreatedAt();
        }

        return $this->logs->getFirstLog()->toArray()[0]->getMeasurementTime();
    }
}