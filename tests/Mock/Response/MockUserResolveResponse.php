<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockUserResolveResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 201;
    }

    public function getContent(): array
    {
        return [
            "id" => 47055,
        ];
    }
}