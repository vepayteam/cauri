<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40102Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 401;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40102,
                'message' => 'Authentication token is missing.'
            ]
        ];
    }
}