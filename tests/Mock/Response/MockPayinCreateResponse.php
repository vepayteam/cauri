<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockPayinCreateResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 201;
    }

    public function getContent(): array
    {
        return [
            "id" => 1326123574311498453,
            "orderId" => "1",
            "success" => true,
            "referenceId" => null,
            "price" => "5.99",
            "fee" => "0.0000",
            "currency" => "USD",
            "type" => "payment",
            "status" => "completed",
            "createdAt" => "2017-05-08T11:08:26+00:00",
            "updatedAt" => "2017-05-08T11:08:34+00:00",
            "user" => [
                "id" => 17,
                "identifier" => "1",
                "displayName" => "User",
                "email" => "user@example.com",
                "phone" => "11111111111",
                "ip" => "127.0.0.1",
                "locale" => "ru"
            ],
            "card" => [
                "lastFour" => "1112",
                "mask" => "************1112",
                "expirationMonth" => 12,
                "expirationYear" => 2034,
                "expiresAt" => "2035-01-01T00:00:00+00:00",
                "holder" => null,
                "scheme" => "visa",
                "bankName" => "EXTRAS TEST - VISA",
                "country" => "US"
            ],
            "acs" => [
                "url" => "https://bank.example.com/ACS/",
                "parameters" => [
                    "MD" => "eyJ0cmFuc2Fj...",
                     "PaReq" => "eJxdUWF...",
                     "TermUrl" => "https://example.com/acs_return/"
                ]
            ],
            "permanentToken" => "d5c83ed1575b6fa30e8b977016c75a5417c5c9d34930d7076e9e36f374577345",
            "recurring" => [
                "frequency" => 1,
                 "endsAt" => "20151022T11:49:23+03:00"
            ]
        ];
    }
}