<?php

namespace App\Command;

use App\Document\PowerStationLog;
use App\Repository\PowerStationReportRepository;
use App\Repository\PowerStationRepository;
use App\Service\GeneratorPowerStationReportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'generate:prower-station-report',
    description: 'Generate power station reports',
)]
class GeneratePowerStationReportCommand extends Command
{
    private PowerStationRepository $powerStations;

    private GeneratorPowerStationReportService $generator;
    public function __construct(
        PowerStationRepository $powerStations,
        GeneratorPowerStationReportService $generator,
        string $name = null
    ) {
        $this->powerStations = $powerStations;
        $this->generator = $generator;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        return;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Start generating');

        $date =  $this->generator->getReportDate();

        $io->info('Reporting for date: ' . $date->format(PowerStationLog::DATE_TIME_FORMAT));

        $allStations = $this->powerStations->getAllPowerStationIds();
        foreach ($allStations as $station) {
            $io->text('Generation for power station:' . $station);
            try {
                $this->generator->generateReport($station, $date);
            } catch (\Exception $exception) {
                $io->error($exception->getMessage());
            }
        }

        $io->title('Ended generating');
        return Command::SUCCESS;
    }
}
