<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40011Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 400;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40011,
                'message' => 'User\'s IP address is missing.'
            ]
        ];
    }
}