<?php

namespace Vepay\Cauri\Tests\Mock\Response;

use Vepay\Gateway\Tests\Mock\Response\MockResponseInterface;

class MockBalanceResponse implements MockResponseInterface
{
    public function getStatus(): ?string
    {
        return 200;
    }

    public function getContent(): array
    {
        return [
            "amount" => "100.00",
            "rolling_reserve"=> "0.20",
            "currency" => "USD",
            "base_amount" => "1286.27",
            "base_rolling_reserve" => "0.00"
        ];
    }
}