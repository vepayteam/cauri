<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class UserRecurringSettingsChangeRequest
 * @package Vepay\Cauri\Client\Request
 */
class UserRecurringSettingsChangeRequest extends Request
{
    /** @var string  */
    protected $endpoint = 'v1/user/changeRecurring';
    /** @var string  */
    protected $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('user', Validator::REQUIRED)
            ->set('interval', Validator::OPTIONAL)
            ->set('price', Validator::OPTIONAL)
            ->set('currency', Validator::OPTIONAL);
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