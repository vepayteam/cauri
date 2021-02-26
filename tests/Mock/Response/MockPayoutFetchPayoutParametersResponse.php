<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockPayoutFetchPayoutParametersResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            [
                'name' => 'amount',
                'type' => 'text',
                'label' => 'Amount',
                'required' => true
            ],
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Phone',
                'required' => true
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Description',
                'required' => false
            ]
        ];
    }
}