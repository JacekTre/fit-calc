<?php

namespace App\Service;

use App\Document\PowerStation;
use App\Document\PowerStationLog;
use App\Hydrator\CreatePowerStationHydrator;
use App\Hydrator\CreatePowerStationLogHydrator;
use App\Repository\PowerStationLogRepository;
use App\Repository\PowerStationRepository;
use Symfony\Component\HttpFoundation\Request;

class PowerStationLogService
{
    private PowerStationLogRepository $powerStationLogs;

    private PowerStationRepository $powerStations;

    private CreatePowerStationLogHydrator $createPowerStationLogHydrator;

    private CreatePowerStationHydrator $createPowerStationHydrator;

    public function __construct(
        PowerStationLogRepository $powerStationLogs,
        CreatePowerStationLogHydrator $createPowerStationLogHydrator,
        CreatePowerStationHydrator $createPowerStationHydrator,
        PowerStationRepository $powerStations
    ) {
        $this->powerStationLogs = $powerStationLogs;
        $this->createPowerStationLogHydrator = $createPowerStationLogHydrator;
        $this->createPowerStationHydrator = $createPowerStationHydrator;
        $this->powerStations = $powerStations;
    }

    public function createLog(Request $request): PowerStationLog
    {
        $log = $this->createPowerStationLogHydrator::hydrate($request->toArray()['measurement']);

        $powerStation = $this->powerStations->getById($log->getPowerStationId());
        $this->powerStationLogs->save($log);


        if (! $powerStation instanceof PowerStation) {
            $powerStation = $this->createPowerStationHydrator::hydrate($log->getPowerStationId());
            $this->powerStations->save($powerStation);
        }

        return $log;
    }
}