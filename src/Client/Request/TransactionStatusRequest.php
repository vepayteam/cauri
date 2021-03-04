<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Gateway\Client\Request\EndpointModificator;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class TransactionStatusRequest
 * @package Vepay\Cauri\Client\Request
 */
class TransactionStatusRequest extends Request
{
    use EndpointModificator;

    /** @var string  */
    protected $endpoint = 'v1/transactions/{id}';
    /** @var string  */
    protected $method = 'GET';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#get-transaction-by-id
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('id', Validator::REQUIRED);
        // project - will add in Middleware Project
        // signature - will generate and add in Middleware Signature
    }

    /**
     * @return Validator
     */
    public function getOptionsValidator(): Validator
    {
        return (new Validator)
            ->set('public_key', Validator::REQUIRED)
            ->set('private_key', Validator::REQUIRED);
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return [new Project, new Signature];
    }
}