<?php

declare(strict_types=1);

namespace App\Diet\Application;

interface QueryBusInterface
{
    public function dispatch(object $query);
}
