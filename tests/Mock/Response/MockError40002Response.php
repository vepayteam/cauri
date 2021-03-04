<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40002Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 400;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40002,
                'message' => 'User\'s identifier is missing.'
            ]
        ];
    }
}