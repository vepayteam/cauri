<?php

namespace Vepay\Cauri\Resource;

use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\BalanceGetRequest;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Gateway\Resource\MockBehavior;
use Exception;

/**
 * Class Balance
 * @package Vepay\Cauri\Resource
 */
class Balance extends AbstractResource
{
    use MockBehavior;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#get-merchants-balance
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function getBalance(array $parameters, array $options = []): ResponseInterface
    {
        $request = new BalanceGetRequest($parameters, $options);
        return ClientConfigurator
            ::get()
            ->send($request);
    }
}
