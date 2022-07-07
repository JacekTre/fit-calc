<?php

namespace App\Controller;

use App\Extractor\PowerStationLogExtractor;
use App\Hydrator\CreatePowerStationLogHydrator;
use App\Service\ApiResponse\FailureResponse;
use App\Service\ApiResponse\SuccessResponse;
use App\Service\PowerStationLogService;
use App\Validator\PowerStationLogValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Route("/api/v1")
 */
class ApiPowerStationLogController extends AbstractController
{
    private PowerStationLogService $powerStationLogService;

    private PowerStationLogExtractor $powerStationLogExtractor;

    public function __construct(
        PowerStationLogService $powerStationLogService,
        PowerStationLogExtractor $powerStationLogExtractor
    ) {
        $this->powerStationLogService = $powerStationLogService;
        $this->powerStationLogExtractor = $powerStationLogExtractor;
    }
    /**
     * @Route("/power-station-log", name="api_power_station_log", methods={"POST"})
     */
    public function index(Request $request): Response
    {
        try {
            (new PowerStationLogValidator($request))->validate();

            $log = $this->powerStationLogService->createLog($request);
            return $this->json((new SuccessResponse($this->powerStationLogExtractor::extract($log)))->toArray());
        } catch (\Exception $exception) {
            return $this->json((new FailureResponse($exception->getMessage(), $request->toArray()))->toArray());
        }
    }
}
