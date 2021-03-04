<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockPayoutCreateResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            'id' => '1534974617313178347',
            'status' => 'processing',
            'success' => true
        ];
    }
}