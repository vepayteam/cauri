<?php

namespace Vepay\Cauri\Resource;

use Exception;
use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\TransactionCreateRequest;
use Vepay\Cauri\Client\Request\TransactionStatusRequest;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Gateway\Resource\MockBehavior;

/**
 * Class Transaction
 * @package Vepay\Cauri\Resource
 */
class Transaction extends AbstractResource
{
    use MockBehavior;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-new-transaction
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function create(array $parameters, array $options = []): ResponseInterface
    {
        $request = new TransactionCreateRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#get-transaction-by-id
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function status(array $parameters, array $options = []): ResponseInterface
    {
        $request = new TransactionStatusRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}