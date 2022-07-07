<?php

namespace App\Repository;

use App\Document\PowerStationLog;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class PowerStationLogRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        parent::__construct(
            $dm,
            $dm->getUnitOfWork(),
            $dm->getClassMetadata(PowerStationLog::class)
        );
    }

    public function getListByPowerStationId(int $powerStationId, \DateTime $start = null, \DateTime $end = null)
    {
        $qb = $this->createQueryBuilder();
        $qb->field('powerStationId')->equals($powerStationId);

        if ($start instanceof \DateTime) {
            $qb->addAnd($qb->expr()->field('measurementTime')->gt($start));
        }

        if ($end instanceof \DateTime) {
            $qb->addAnd($qb->expr()->field('measurementTime')->lt($end));
        }

        return $qb->getQuery()->execute();
    }

    public function getFirstLog()
    {
        return $this
            ->createQueryBuilder()
            ->sort('measurementTime', 'ASC')
            ->limit(1)
            ->getQuery()
            ->execute();
    }

    public function save(PowerStationLog $log): void
    {
        $this->getDocumentManager()->persist($log);
        $this->getDocumentManager()->flush();
    }
}