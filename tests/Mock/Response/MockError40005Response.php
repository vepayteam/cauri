<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40005Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 400;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40005,
                'message' => 'The expiry is invalid.'
            ]
        ];
    }
}