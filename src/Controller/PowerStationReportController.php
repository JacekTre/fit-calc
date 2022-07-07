<?php

namespace App\Controller;

use App\Service\PowerStationReportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PowerStationReportController extends AbstractController
{
    private PowerStationReportService $service;

    public function __construct(
        PowerStationReportService $service
    ) {
        $this->service = $service;
    }

    /**
     * @Route("/report", name="app_report")
     */
    public function index(): Response
    {
        try {
            return $this->render('power_station_report/index.html.twig');
        } catch (\Exception $exception) {
            //todo: Add to logging and exception handling
            dd($exception->getMessage());
        }
    }

    /**
     * @Route("/report/show", name="app_main_get_all", methods={"POST"})
     */
    public function show(Request $request): Response
    {
        try {
            $result = $this->service->getFilteredReports($request->request->all());

            return $this->render('power_station_report/show.html.twig', [
                'result' => $result
            ]);
        } catch (\Exception $exception) {
            //todo: Add to logging and exception handling
            dd($exception->getMessage());
        }
    }
}
