<?php

namespace Vepay\Cauri\Client;

use Vepay\Gateway\Client\AbstractClientConfigurator;

class ClientConfigurator extends AbstractClientConfigurator
{
    public static function getGatewayName(): string
    {
        return 'cauri';
    }

    public static function getOptions(): array
    {
        return ['base_uri' => 'https://api.pa.cauri.com'];
    }
}