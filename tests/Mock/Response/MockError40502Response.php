<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40502Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 405;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40502,
                'message' => 'Recurring payments are too frequent for requested user.'
            ]
        ];
    }
}