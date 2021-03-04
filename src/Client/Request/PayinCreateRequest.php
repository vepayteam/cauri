<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class PayinCreateRequest
 * @package Vepay\Cauri\Client\Request
 */
class PayinCreateRequest extends Request
{
    /** @var string  */
    protected $endpoint = 'v1/card/process';
    /** @var string  */
    protected $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('user', Validator::REQUIRED)
            ->set('card_token', Validator::OPTIONAL)
            ->set('card', Validator::OPTIONAL)
            ->set('price', Validator::REQUIRED)
            ->set('currency', Validator::REQUIRED)
            ->set('order_id', Validator::OPTIONAL)
            ->set('description', Validator::REQUIRED)
            ->set('3ds', Validator::OPTIONAL)
            ->set('acs_return_url', Validator::OPTIONAL)
            ->set('remember', Validator::OPTIONAL)
            ->set('verify_card', Validator::OPTIONAL)
            ->set('recurring', Validator::OPTIONAL)
            ->set('recurring_interval', Validator::OPTIONAL)
            ->set('recurring_trial', Validator::OPTIONAL)
            ->set('attr_*', Validator::OPTIONAL);
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