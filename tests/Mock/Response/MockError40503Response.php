<?php

namespace Vepay\Gratapay\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockError40503Response implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 405;
    }

    public function getContent(): array
    {
        return [
            'error' => [
                'code' => 40503,
                'message' => 'Unable to create recurrent transaction.'
            ]
        ];
    }
}