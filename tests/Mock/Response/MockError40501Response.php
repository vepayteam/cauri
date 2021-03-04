<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40501Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 405;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40501,
                'message' => 'Transaction is already completed.'
            ]
        ];
    }
}