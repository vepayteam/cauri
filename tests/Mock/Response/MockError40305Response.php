<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40305Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 403;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40305,
                'message' => 'Credit card token is already used.'
            ]
        ];
    }
}