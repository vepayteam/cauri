<?php

namespace Vepay\Cauri\Resource;

use Exception;
use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\CardManualRecurringRequest;
use Vepay\Cauri\Client\Request\CardTokenCreateRequest;
use Vepay\Cauri\Client\Request\CardAuthenticateRequest;
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
     * @throws Exception
     */
    protected function tokenCreate(array $parameters, array $options = []): ResponseInterface
    {
        $request = new CardTokenCreateRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function authenticate(array $parameters, array $options = []): ResponseInterface
    {
        $request = new CardAuthenticateRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#manual-recurring
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function manualRecurring(array $parameters, array $options = []): ResponseInterface
    {
        $request = new CardManualRecurringRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}