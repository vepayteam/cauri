<?php

namespace Vepay\Cauri\Tests;

use Vepay\Gateway\Config;
use Vepay\Gateway\Logger\Logger;
use Vepay\Gateway\Logger\LoggerInterface;

trait InitializationTrait
{
    public function getTestCard(): array
    {
        return [
            'number' => '4012001037141112',
            'holder' => 'Firstname Lastname',
            'expiration_date' => '04/24',
            'expiration_month' => '4',
            'expiration_year' => '2024',
            'security_code' => '123',
        ];
    }

    public function setUp(): void
    {
        Config::getInstance()->tests = [
            'public_key' => '109630cfa014306d29b9ac1a547ff277',
            'private_key' => '38a26d14b5ff1b7398c3087bcacfccbb',
        ];

        Config::getInstance()->logger = Logger::class;
        Config::getInstance()->logLevel = LoggerInterface::TRACE_LOG_LEVEL;
    }
}