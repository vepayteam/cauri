<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40302Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 403;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40302,
                'message' => 'Authentication token is invalid.'
            ]
        ];
    }
}