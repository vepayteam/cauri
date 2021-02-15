<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40407Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 404;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40407,
                'message' => 'Platform user is missing.'
            ]
        ];
    }
}