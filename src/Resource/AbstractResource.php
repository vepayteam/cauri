<?php

namespace Vepay\Cauri\Resource;

use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Gateway\Client\ClientInterface;
use Vepay\Gateway\Resource\ResourceInterface;

class AbstractResource implements ResourceInterface
{
    public function getClient(): ClientInterface
    {
        return ClientConfigurator::get();
    }
}