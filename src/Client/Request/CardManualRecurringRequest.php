<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class CardManualRecurringRequest
 * @package Vepay\Cauri\Client\Request
 */
class CardManualRecurringRequest extends Request
{
    /** @var string  */
    protected $endpoint = 'v1/card/processRecurring';
    /** @var string  */
    protected $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#manual-recurring
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('user', Validator::REQUIRED)
            ->set('price', Validator::REQUIRED)
            ->set('currency', Validator::REQUIRED)
            ->set('order_id', Validator::OPTIONAL)
            ->set('description', Validator::OPTIONAL);
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