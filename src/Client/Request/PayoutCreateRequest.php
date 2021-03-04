<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Cauri\Resource\Payout;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class PayoutCreateRequest
 * @package Vepay\Cauri\Client\Request
 */
class PayoutCreateRequest extends Request
{
    /** @var string  */
    protected $endpoint = 'v1/payout';
    /** @var string  */
    protected $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-payout
     *
     * @return Validator
     * @throws \Exception
     */
    public function getParametersValidator(): Validator
    {
        $validator = (new Validator)
            ->set('type', Validator::REQUIRED)
            ->set('amount', Validator::REQUIRED)
            ->set('currency', Validator::REQUIRED)
            ->set('description', Validator::REQUIRED)
            ->set('orderId', Validator::OPTIONAL)
            ->set('account', Validator::REQUIRED)
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

        $response = (new Payout())->fetchPayoutParameters(
            [
                'type' => $this->parameters['type'],
                'account' => $this->parameters['account'],
                'currency' => $this->parameters['currency'],
            ],
            [
                'public_key' => $this->getOptions()['public_key'],
            ]
        );

        foreach ($response->getContent() as $parameter) {
            $validator->set($parameter['name'], $parameter['required'] ? Validator::REQUIRED : Validator::OPTIONAL);
        }

        return $validator;
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