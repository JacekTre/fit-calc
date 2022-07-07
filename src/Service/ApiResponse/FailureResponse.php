<?php

namespace App\Service\ApiResponse;

class FailureResponse extends AbstractResponse
{
    private string $message;

    public function __construct(string $message, array $context = [])
    {
        $this->status = self::FAILURE;
        $this->message = $message;
        $this->context = $context;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'context' => $this->context
        ];
    }
}