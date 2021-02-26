<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockUserRecurringCancelResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            "success" => true,
        ];
    }
}