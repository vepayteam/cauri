<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockCardTokenCreateResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            "id" => "11fe4b4d430eccc4ca59b8df31bc5d161b4d54020082362a7d389486f5349066",
            "expiresAt" => "20150522T11:21:37+03:00",
            "card" => [
                "lastFour" => "1112",
                "mask" => "************1112",
                "type" => "visa",
                "expirationMonth" => 4,
                "expirationYear" => 2020
            ],
        ];
    }
}