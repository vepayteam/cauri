<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockPayinCardAuthenticateResponse implements MockResponseInterface
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
            ],
            "permanentToken" => "9a083895d07ca58f6e5505bd19ed35ca9a083895d07ca58f6e5505bd19ed35ca",
            "recurring" => [
                "frequency" => 1,
                 "endsAt" => "20151022T11:49:23+03:00"
            ]
        ];
    }
}