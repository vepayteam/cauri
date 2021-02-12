<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockRefundCreateResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 201;
    }

    public function getContent(): array
    {
        return [
            'success' => true,
            'id' => 1326123574311498453,
            'orderId' => '1',
            'referenceId' => null,
            'price' => '5.99',
            'fee' => '0.0000',
            'currency' => 'USD',
            'type' => 'payment',
            'status' => 'completed',
            'createdAt' => '2017-05-08T11:08:26+00:00',
            'updatedAt' => '2017-05-08T11:08:34+00:00',
            'user' => [
                'id' => 17,
                'identifier' => '1',
                'displayName' => 'User',
                'email' => 'user@example.com',
                'phone' => '11111111111',
                'ip' => '127.0.0.1',
                'locale' => 'ru'
            ],
            'card' => [
                'lastFour' => '1112',
                'mask' => '************1112',
                'expirationMonth' => 12,
                'expirationYear' => 2034,
                'expiresAt' => '2035-01-01T00:00:00+00:00',
                'holder' => null,
                'scheme' => 'visa',
                'bankName' => 'EXTRAS TEST - VISA',
                'country' => 'US'
            ]
        ];
    }
}