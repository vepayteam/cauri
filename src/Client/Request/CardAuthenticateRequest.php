<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\PostSign;
use Vepay\Cauri\Client\Middleware\ProjectBody;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class CardAuthenticateRequest
 * @package Vepay\Cauri\Client\Request
 */
class CardAuthenticateRequest extends Request
{
    protected string $endpoint = 'v1/card/authenticate';
    protected string $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('PaRes', Validator::REQUIRED)
            ->set('MD', Validator::REQUIRED);
        // project - will add in Middleware ProjectBody
        // signature - will generate and add in Middleware PostSign
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
        return [new ProjectBody, new PostSign];
    }
}