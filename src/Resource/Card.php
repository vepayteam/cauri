<?php

namespace Vepay\Cauri\Resource;

use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\CardTokenCreateRequest;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Gateway\Resource\MockBehavior;

/**
 * Class Card
 * @package Vepay\Cauri\Resource
 */
class Card extends AbstractResource
{
    use MockBehavior;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws \Exception
     */
    protected function tokenCreate(array $parameters, array $options = []): ResponseInterface
    {
        $request = new CardTokenCreateRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}