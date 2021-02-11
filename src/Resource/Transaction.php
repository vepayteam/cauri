<?php

namespace Vepay\Cauri\Resource;

use Exception;
use Vepay\Cauri\Client\ClientConfigurator;
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
     * Documentation: https://docs.pa.cauri.com/api/#reverse-a-payment
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws Exception
     */
    protected function paymentReverse(array $parameters, array $options = []): ResponseInterface
    {
        $request = new TransactionPaymentReverseRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}