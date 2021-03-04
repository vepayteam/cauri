<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockTransactionStatusResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            'id' => '1569310086280783205',
            'orderId' => 'qwery12345',
            'referenceId' => null,
            'price' => '150.00',
            'fee' => '0.0000',
            'currency' => 'RUB',
            'type' => 'payment',
            'status' => 'refunded',
            'method' => 'yandex_money',
            'originalStatus' => 'completed',
            'user' => [
                'id' => 17,
                'identifier' => '1',
                'displayName' => 'LuxeMate',
                'email' => 'user@example.com',
                'phone' => '7777777777',
                'ip' => '127.0.0.1',
                'locale' => 'ru'
            ],
            'createdAt' => '2017-05-08T11:08:26+00:00',
            'updatedAt' => '2017-05-08T11:08:34+00:00',
            'reason' => null
        ];
    }
}