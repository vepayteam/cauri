<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockCardManualRecurringResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 201;
    }

    public function getContent(): array
    {
        return [
            "id" => 1326123574311498453,
            "success" => true,
            "card" => [
                "lastFour" => "1112",
                "mask" => "************1112",
                "type" => "visa",
                "expirationMonth" => 4,
                "expirationYear" => 2020
            ]
        ];
    }
}