<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockTransactionCreateResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            'id' => '1530105654244093715',
            'amount' => 5.99,
            'currency' => 'USD',
            'status' => 'opened'
        ];
    }
}