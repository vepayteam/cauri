<?php

namespace Vepay\Cauri\Tests;

use Vepay\Gateway\Config;
use Vepay\Gateway\Logger\Logger;

trait InitializationTrait
{
    public function setUp(): void
    {
        Config::getInstance()->tests = [
            'private_key' => '1111111111111111111111111111111111111111'
        ];

        Config::getInstance()->logger = Logger::class;
    }
}