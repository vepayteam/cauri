<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\PostSign;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class TransactionPaymentReverseRequest
 * @package Vepay\Cauri\Client\Request
 */
class TransactionPaymentReverseRequest extends Request
{
    protected string $endpoint = 'v1/transaction/reverse';
    protected string $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#reverse-a-payment
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('project', Validator::REQUIRED)
            ->set('id', Validator::OPTIONAL)
            ->set('order_id', Validator::OPTIONAL)
            ->set('amount', Validator::REQUIRED)
            ->set('comment', Validator::OPTIONAL);
        // signature - will generate and add in Middleware PostSign
    }

    /**
     * @return Validator
     */
    public function getOptionsValidator(): Validator
    {
        return (new Validator)
            ->set('private_key', Validator::REQUIRED);
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return [new PostSign];
    }
}