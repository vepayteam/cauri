<?php

namespace Vepay\Cauri\Tests\Unit\Resource;

use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Card;
use Vepay\Cauri\Resource\Payout;
use Vepay\Cauri\Resource\Refund;
use Vepay\Cauri\Resource\User;
use Vepay\Gateway\Client\Validator\ValidationException;
use Vepay\Gateway\Config;
use Vepay\Cauri\Resource\Payin;
use Vepay\Cauri\Resource\Transaction;
use Vepay\Cauri\Tests\InitializationTrait;

class ValidatorBehaviorTest extends TestCase
{
    use InitializationTrait;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     */
    public function testPayinPayinCreateValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Payin())->create(
            ['price' => '0.01', 'currency' => 'RUB'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     */
    public function testCardTokenCreateValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Card())->tokenCreate(
            ['project' => '1111111111', 'number' => '1111'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     */
    public function testCardAuthenticateValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Card())->authenticate(
            ['project' => '1111111111', 'PaRes' => '1111'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#manual-recurring
     */
    public function testCardManualRecurringValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Card())->manualRecurring(
            ['project' => '1111111111', 'price' => '1111'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#resolve-a-user
     */
    public function testUserResolveValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new User())->resolve(
            ['project' => '1111111111', 'identifier' => '1111'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     */
    public function testUserChangeRecurringSettingsValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new User())->recurringSettingsChange(
            ['project' => '1111111111', 'user' => '1111'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#cancel-recurring
     */
    public function testUserCancelRecurringValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new User())->recurringCancel(
            ['project' => '1111111111'],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#reverse-a-payment
     */
    public function testRefundCreateValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Refund())->create(
            ['project' => '1111111111', 'id' => 111111],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-new-transaction
     */
    public function testTransactionCreateValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Transaction())->paymentReverse(
            ['project' => '1111111111', 'id' => 111111],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#get-transaction-by-id
     */
    public function testTransactionStatusValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Transaction())->status(
            [],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-available-payout-types
     */
    public function testPayoutFetchAvailablePayoutTypesValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Payout())->fetchAvailablePayoutTypes(
            [],
            []
        );
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-payout-parameters
     */
    public function testPayoutFetchPayoutParametersValidation(): void
    {
        $this->expectException(ValidationException::class);

        (new Payout())->fetchPayoutParameters(
            [
                'type' => 'test_type',
                'account' => 'test_account',
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );
    }
}
