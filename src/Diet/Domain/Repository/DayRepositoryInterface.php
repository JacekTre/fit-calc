<?php

namespace App\Diet\Domain\Repository;

use App\Diet\Domain\Model\Day;

interface DayRepositoryInterface
{
    public function save(Day $day): void;

    public function remove(Day $day): void;
}