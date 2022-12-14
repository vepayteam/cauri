<?php

namespace Vepay\Cauri\Client\Request;

use Vepay\Cauri\Client\Middleware\Signature;
use Vepay\Cauri\Client\Middleware\Project;
use Vepay\Gateway\Client\Request\Request;
use Vepay\Gateway\Client\Validator\Validator;

/**
 * Class TransactionCreateRequest
 * @package Vepay\Cauri\Client\Request
 */
class TransactionCreateRequest extends Request
{
    /** @var string  */
    protected $endpoint = 'v1/transaction/create';
    /** @var string  */
    protected $method = 'POST';

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-new-transaction
     *
     * @return Validator
     */
    public function getParametersValidator(): Validator
    {
        return (new Validator)
            ->set('user', Validator::REQUIRED)
            ->set('display_name', Validator::OPTIONAL)
            // Possible values are: paypal, qiwi, yandex_money_wallet, yandex_money_wallet_v2, web_money_wme,
            // web_money_wmz, web_money_wmr.
            ->set('payment_method', Validator::REQUIRED)
            ->set('price', Validator::REQUIRED)
            ->set('currency', Validator::REQUIRED)
            ->set('email', Validator::OPTIONAL)
            ->set('ip', Validator::OPTIONAL)
            ->set('ua', Validator::OPTIONAL)
            ->set('phone', Validator::OPTIONAL)
            ->set('locale', Validator::OPTIONAL)
            ->set('order_id', Validator::OPTIONAL)
            ->set('description', Validator::REQUIRED)
            ->set('success_url', Validator::REQUIRED)
            ->set('fail_url', Validator::REQUIRED);
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