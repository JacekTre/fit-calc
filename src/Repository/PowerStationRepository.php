<?php

namespace App\Repository;

use App\Document\PowerStation;
use App\Document\PowerStationLog;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class PowerStationRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        parent::__construct(
            $dm,
            $dm->getUnitOfWork(),
            $dm->getClassMetadata(PowerStation::class)
        );
    }

    public function getById(int $id): ?PowerStation
    {
        return $this->findOneBy(['powerStationId' => $id]);
    }

    //todo: Change to array with objects
    public function getAllPowerStationIds(): array
    {
        return $this->createQueryBuilder()
            ->sort('powerStationId', 'DESC')
            ->distinct('powerStationId')
            ->getQuery()
            ->execute();
    }

    public function save(PowerStation $powerStation): void
    {
        $this->getDocumentManager()->persist($powerStation);
        $this->getDocumentManager()->flush();
    }
}