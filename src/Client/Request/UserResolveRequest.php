<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class UserResolveRequest
 * @package Vepay\Cauri\Client\Request
 */
class UserResolveRequest extends Request
{
    /** @var string  */
    protected $endpoint = 'v1/user/resolve';
    /** @var string  */
    protected $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#resolve-a-user
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('identifier', Validator::REQUIRED)
            ->set('display_name', Validator::OPTIONAL)
            ->set('email', Validator::OPTIONAL)
            ->set('phone', Validator::OPTIONAL)
            ->set('locale', Validator::OPTIONAL)
            ->set('ip', Validator::REQUIRED)
            ->set('ua', Validator::OPTIONAL);
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