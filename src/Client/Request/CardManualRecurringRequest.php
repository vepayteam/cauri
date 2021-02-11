<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\PostSign;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class CardManualRecurringRequest
 * @package Vepay\Cauri\Client\Request
 */
class CardManualRecurringRequest extends Request
{
    protected string $endpoint = 'v1/card/processRecurring';
    protected string $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#manual-recurring
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('project', Validator::REQUIRED)
            ->set('user', Validator::REQUIRED)
            ->set('price', Validator::REQUIRED)
            ->set('currency', Validator::REQUIRED)
            ->set('order_id', Validator::OPTIONAL)
            ->set('description', Validator::OPTIONAL);
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