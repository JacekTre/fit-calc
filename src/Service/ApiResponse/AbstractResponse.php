<?php

namespace App\Service\ApiResponse;

abstract class AbstractResponse
{
    protected const SUCCESS = 'SUCCESS';

    protected const FAILURE = 'FAILURE';

    protected string $status;

    protected array $context;
}