<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\PostSign;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class UserCancelRecurringRequest
 * @package Vepay\Cauri\Client\Request
 */
class UserCancelRecurringRequest extends Request
{
    protected string $endpoint = 'v1/user/cancelRecurring';
    protected string $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#cancel-recurring
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('project', Validator::REQUIRED)
            ->set('user', Validator::REQUIRED);
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