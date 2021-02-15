<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class PayoutCreateRequest
 * @package Vepay\Cauri\Client\Request
 */
class PayoutCreateRequest extends Request
{
    protected string $endpoint = 'v1/payout';
    protected string $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-payout
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('type', Validator::REQUIRED)
            ->set('amount', Validator::REQUIRED)
            ->set('currency', Validator::REQUIRED)
            ->set('description', Validator::REQUIRED)
            ->set('orderId', Validator::OPTIONAL)
            ->set('account', Validator::OPTIONAL)
            ->set('cardExpirationDate', Validator::OPTIONAL)
            ->set('cardToken', Validator::OPTIONAL)
            ->set('phone', Validator::OPTIONAL)
            ->set('cardHolder', Validator::OPTIONAL)
            ->set('birthDate', Validator::OPTIONAL)
            ->set('receiverBankBIC', Validator::OPTIONAL)
            ->set('fullName', Validator::OPTIONAL)
            ->set('lastName', Validator::OPTIONAL)
            ->set('country', Validator::OPTIONAL)
            ->set('city', Validator::OPTIONAL)
            ->set('address', Validator::OPTIONAL)
            ->set('postalCode', Validator::OPTIONAL)
            ->set('beneficiaryFirstName', Validator::OPTIONAL)
            ->set('beneficiaryLastName', Validator::OPTIONAL)
            ->set('firstName', Validator::OPTIONAL);
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