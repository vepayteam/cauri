<?php

namespace Vepay\Cauri\Resource;

use Exception;
use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\PayinCreateRequest;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Gateway\Resource\MockBehavior;

/**
 * Class Payin
 * @package Vepay\Cauri\Resource
 */
class Payin extends AbstractResource
{
    use MockBehavior;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function create(array $parameters, array $options): ResponseInterface
    {
        $request = new PayinCreateRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}