<?php

namespace Vepay\Cauri\Resource;

use Exception;
use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\PayoutFetchAvailablePayoutTypesRequest;
use Vepay\Cauri\Client\Request\PayoutFetchPayoutParametersRequest;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Gateway\Resource\MockBehavior;

/**
 * Class Payout
 * @package Vepay\Cauri\Resource
 */
class Payout extends AbstractResource
{
    use MockBehavior;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-available-payout-types
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function fetchAvailablePayoutTypes(array $parameters, array $options): ResponseInterface
    {
        $request = new PayoutFetchAvailablePayoutTypesRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-payout-parameters
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function fetchPayoutParameters(array $parameters, array $options): ResponseInterface
    {
        $request = new PayoutFetchPayoutParametersRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}