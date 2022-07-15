<?php

namespace App\Diet\Domain\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use PDO;

abstract class AbstractRepository
{
    protected EntityManagerInterface $entityManager;

    protected PDO $pdo;

    public function __construct(
        EntityManagerInterface $entityManager,
    ){
        // postgresql://postgres:postgres@10.24.0.3:5432/fitcalc?serverVersion=13&charset=utf8
        $this->entityManager = $entityManager;
        $dsn = 'pgsql:host=' . '10.24.0.3' .
            ';dbname='    . 'fitcalc' .
            ';port='      . 5432 .
            ';connect_timeout=15';
        $this->pdo = new PDO($dsn, 'postgres', 'postgres');
    }

    public function getConnection(): Connection
    {
        return $this->entityManager->getConnection();
    }
}