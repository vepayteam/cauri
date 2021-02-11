<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\PostSign;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class UserChangeRecurringSettingsRequest
 * @package Vepay\Cauri\Client\Request
 */
class UserChangeRecurringSettingsRequest extends Request
{
    protected string $endpoint = 'v1/user/changeRecurring';
    protected string $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('project', Validator::REQUIRED)
            ->set('user', Validator::REQUIRED)
            ->set('interval', Validator::OPTIONAL)
            ->set('price', Validator::OPTIONAL)
            ->set('currency', Validator::OPTIONAL);
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