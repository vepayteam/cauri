<?php

namespace Vepay\Cauri\Resource;

use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Gateway\Client\ClientInterface;
use Vepay\Gateway\Resource\ResourceInterface;

/**
 * Class AbstractResource
 * @package Vepay\Cauri\Resource
 */
class AbstractResource implements ResourceInterface
{
    /**
     * @return ClientInterface
     * @throws \Exception
     */
    public function getClient(): ClientInterface
    {
        return ClientConfigurator::get();
    }
}