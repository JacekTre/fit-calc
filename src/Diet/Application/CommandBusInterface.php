<?php

namespace App\Diet\Application;

interface CommandBusInterface
{
    public function dispatch(object $command): void;
}