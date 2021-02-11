<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class CardTokenCreateRequest
 * @package Vepay\Cauri\Client\Request
 */
class CardTokenCreateRequest extends Request
{
    protected string $endpoint = 'v1/card/getToken';
    protected string $method = 'GET';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('project', Validator::REQUIRED)
            ->set('number', Validator::REQUIRED)
            ->set('expiration_month', Validator::REQUIRED)
            ->set('expiration_year', Validator::REQUIRED)
            ->set('security_code', Validator::REQUIRED)
            ->set('callback', Validator::OPTIONAL);
    }

    /**
     * @return Validator
     */
    public function getOptionsValidator(): Validator
    {
        return (new Validator);
    }
}