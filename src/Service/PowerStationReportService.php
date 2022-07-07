<?php

namespace App\Service;

use App\Document\PowerStationLog;
use App\Extractor\PowerStationReportExtractor;
use App\Repository\PowerStationReportRepository;

class PowerStationReportService
{
    private PowerStationReportRepository $reports;

    private PowerStationReportExtractor $extractor;

    public function __construct(
        PowerStationReportRepository $reports,
        PowerStationReportExtractor $extractor
    ) {
        $this->reports = $reports;
        $this->extractor = $extractor;
    }

    public function getFilteredReports(array $data): array
    {
        $result['filters'] = $this->handleInputValues($data);
        $reports = $this->reports->getFilteredReports($result['filters'])->toArray();


        foreach ($reports as $report) {
            $result['result'][] = $this->extractor::extract($report);
        }

        return $result;
    }

    private function handleInputValues(array $data): array
    {
        return [
            'powerStationId' => (isset($data['power-station-id'])) ? $this->toPositiveInteger($data['power-station-id']) : null,
            'date' => \DateTime::createFromFormat(PowerStationLog::DATE_TIME_FORMAT, $data['created-at']),
            'averagePower' => (isset($data['average-power'])) ? $this->toPositiveFloat($data['average-power']) : null,
            'pageNumber' => (isset($data['page-number'])) ? $this->toPositiveInteger($data['page-number']) : null,
            'pageSize' => (isset($data['page-size'])) ? $this->toPositiveInteger($data['page-size']) : null,
        ];
    }

    private function toPositiveInteger(string $number): int
    {
        return abs(intval($number));
    }

    private function toPositiveFloat(string $number): int
    {
        return abs(floatval($number));
    }
}