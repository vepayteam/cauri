<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockPayoutFetchAvailablePayoutTypesResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            'success' => true,
            'types' => [
              [
                  'id' => 0,
                 'key' => 'CREDIT_CARD',
                 'label' => 'Credit Card'
              ],
              [
                  'id' => 1,
                 'key' => 'SEPA',
                 'label' => 'Sepa'
              ]
            ]
        ];
    }
}