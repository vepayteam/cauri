<?php

namespace Vepay\Cauri\Client;

use Vepay\Gateway\Client\AbstractClientConfigurator;

/**
 * Class ClientConfigurator
 * @package Vepay\Cauri\Client
 */
class ClientConfigurator extends AbstractClientConfigurator
{
    /**
     * @return string
     */
    public static function getGatewayName(): string
    {
        return 'cauri';
    }

    /**
     * @return string[]
     */
    public static function getOptions(): array
    {
        return ['base_uri' => 'https://api.pa.cauri.com'];
    }
}