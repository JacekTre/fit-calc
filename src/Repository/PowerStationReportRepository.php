<?php

namespace App\Repository;

use App\Document\PowerStation;
use App\Document\PowerStationLog;
use App\Document\PowerStationReport;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class PowerStationReportRepository extends DocumentRepository
{
    public const DEFAULT_PAGE_SIZE = 10;

    public const DEFAULT_PAGE_NUMBER = 1;

    public function __construct(DocumentManager $dm)
    {
        parent::__construct(
            $dm,
            $dm->getUnitOfWork(),
            $dm->getClassMetadata(PowerStationReport::class)
        );
    }

    public function getLastReport()
    {
        return $this->createQueryBuilder()
            ->sort('createdAt', 'DESC')
            ->limit(1)
            ->getQuery()
            ->getSingleResult();
    }

    public function getFilteredReports(array $filters)
    {
        $qb = $this->createQueryBuilder();

        if (! is_null($filters['powerStationId'])) {
            $qb->field('powerStationId')->equals($filters['powerStationId']);
        }

        if ($filters['date'] instanceof \DateTime) {
            $qb->field('measurementTime')->gt($filters['date']);
        }

        if (! is_null($filters['averagePower']) && $filters['averagePower'] > 0) {
            $qb->field('averagePower')->gt($filters['averagePower']);
        }

        $qb->sort('averagePower', 'DESC');

        $pageSize = $filters['pageSize'] ?? self::DEFAULT_PAGE_SIZE;
        $numberPage = $filters['pageNumber'] ?? self::DEFAULT_PAGE_NUMBER;

        $qb->skip($pageSize * $numberPage);
        $qb->limit($pageSize);

        return $qb->getQuery()->execute();
    }

    public function save(PowerStationReport $report): void
    {
        $this->getDocumentManager()->persist($report);
        $this->getDocumentManager()->flush();
    }
}