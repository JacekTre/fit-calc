<?php

namespace App\Diet\Infrastructure\Repository;

use App\Diet\Domain\Model\Day;
use App\Diet\Domain\Repository\AbstractRepository;
use App\Diet\Domain\Repository\DayRepositoryInterface;

class DayRepository extends AbstractRepository implements DayRepositoryInterface
{
    public function save(Day $day): void
    {
        $this->entityManager->persist($day);
        $this->entityManager->flush();
    }

    public function remove(Day $day): void
    {
        $this->entityManager->remove($day);
        $this->entityManager->flush();
    }
}