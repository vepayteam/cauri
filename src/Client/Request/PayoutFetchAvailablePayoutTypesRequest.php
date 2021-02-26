<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class PayoutFetchAvailablePayoutTypesRequest
 * @package Vepay\Cauri\Client\Request
 */
class PayoutFetchAvailablePayoutTypesRequest extends Request
{
    protected string $endpoint = 'v1/payout-types';
    protected string $method = 'GET';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-available-payout-types
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator);
        // project - will add in Middleware Project
    }

    /**
     * @return Validator
     */
    public function getOptionsValidator(): Validator
    {
        return (new Validator)
            ->set('public_key', Validator::REQUIRED);
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return [new Project];
    }
}