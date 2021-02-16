<?php

namespace Vepay\Cauri\Tests\Features\Resource;

use Exception;
use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Card;
use Vepay\Cauri\Resource\Payin;
use Vepay\Cauri\Resource\Payout;
use Vepay\Cauri\Resource\Refund;
use Vepay\Cauri\Resource\Transaction;
use Vepay\Cauri\Resource\User;
use Vepay\Cauri\Tests\InitializationTrait;
use Vepay\Gateway\Config;

class ResourceOperationsRequestTest extends TestCase
{
    use InitializationTrait;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#resolve-a-user
     *
     * @return array
     * @throws Exception
     */
    public function testUserResolve(): array
    {
        $response = (new User())->resolve(
            [
                'identifier' => 1,
                'display_name' => 'Example User',
                'email' => 'user@example.com',
                'phone' => '123456789',
                'locale' => 'en',
                'ip' => '127.0.0.1',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return ['id' => $response->getContent()['id']];
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     *
     * @return array
     * @throws Exception
     */
    public function testCardTokenCreate(): array
    {
        $response = (new Card())->tokenCreate(
            [
                'number' => '4012001037141112',
                'expiration_month' => '4',
                'expiration_year' => '2022',
                'security_code' => '123',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return ['id' => $response->getContent()['id']];
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @depends testUserResolve
     * @depends testCardTokenCreate
     *
     * @param array $userResolve
     * @param array $cardToken
     * @return array
     * @throws Exception
     */
    public function testPayinWithCardTokenCreate(array $userResolve, array $cardToken): array
    {
        $response = (new Payin())->create(
            [
                'user' => $userResolve['id'],
                'card_token' => $cardToken['id'],
                'price' => '5.99',
                'currency' => 'USD',
                'description' => 'My custom description.',
                'recurring' => 1,
                'recurring_interval' => 15,
                'recurring_trial' => 10,
                'attr_test' => 'test',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return $response->getContent();
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testUserRecurringSettingsChange(array $userResolve): void
    {
        try {
            $response = (new User())->recurringSettingsChange(
                [
                    'user' => $userResolve['id'],
                    'interval' => '30',
                    'price' => 3.50,
                    'currency' => 'USD',
                ],
                [
                    'public_key' => Config::getInstance()->tests['public_key'],
                    'private_key' => Config::getInstance()->tests['private_key'],
                ]
            );

            $this->assertEquals(200, $response->getStatus());
        } catch (Exception $exception) {
            $this->assertEquals(403, $exception->getCode());
            $this->assertStringContainsString('Recurring is disabled for requested user.', $exception->getMessage());
        }
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @return array
     * @throws Exception
     */
    public function testPayinWithCardCreate(array $userResolve): array
    {
        $response = (new Payin())->create(
            [
                'user' => [
                    'id' => $userResolve['id'],
                    'identifier' => 1,
                    'displayName' => 'Example User',
                    'email' => 'user@example.com',
                    'phone' => '123456789',
                    'ip' => '127.0.0.1',
                    'locale' => 'en',
                ],
                'price' => '0.01',
                'currency' => 'RUB',
                'description' => 'Test Descr',
                '3ds' => 1,
                'acs_return_url' => "https://example.com/acs_return/",
                'card' => [
                    'number' => '4012001037141112',
                    'expiration_month' => '4',
                    'expiration_year' => '2022',
                    'security_code' => '123',
                    'holder' => 'Firstname Secondname',
                ],
                'attr_test' => 'attr',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return $response->getContent();
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     *
     * @depends testPayinWithCardCreate
     *
     * @param array $payin
     * @throws Exception
     */
    public function testCardAuthenticate(array $payin): void
    {
        $response = (new Card())->authenticate(
            [
                'PaRes' => $payin['acs']['parameters']['PaReq'],
                'MD' => $payin['acs']['parameters']['MD'],
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#manual-recurring
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testCardManualRecurring(array $userResolve): void
    {
        try {
            $response = (new Card())->manualRecurring(
                [
                    'user' => $userResolve['id'],
                    'price' => 1.0,
                    'currency' => 'RUB',
                    'order_id' => '12345',
                    'description' => 'My custom description.',
                ],
                [
                    'public_key' => Config::getInstance()->tests['public_key'],
                    'private_key' => Config::getInstance()->tests['private_key'],
                ]
            );

            $this->assertEquals(200, $response->getStatus());
        } catch (Exception $exception) {
            $this->assertEquals(405, $exception->getCode());
            $this->assertStringContainsString(
                'Recurring payments are too frequent for requested user.',
                $exception->getMessage()
            );
        }
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#cancel-recurring
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testUserRecurringCancel(array $userResolve): void
    {
        try {
            $response = (new User())->recurringCancel(
                [
                    'user' => $userResolve['id'],
                ],
                [
                    'public_key' => Config::getInstance()->tests['public_key'],
                    'private_key' => Config::getInstance()->tests['private_key'],
                ]
            );

            $this->assertEquals(200, $response->getStatus());
        } catch (Exception $exception) {
            $this->assertEquals(403, $exception->getCode());
            $this->assertStringContainsString('Recurring is disabled for requested user.', $exception->getMessage());
        }
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#reverse-a-payment
     *
     * @depends testPayinWithCardTokenCreate
     *
     * @param array $payin
     * @throws Exception
     */
    public function testRefundCreate(array $payin): void
    {
        $response = (new Refund())->create(
            [
                'id' => $payin['id'],
                'amount' => 0.01,
                'comment' => 'Suspected fraud.',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-new-transaction
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @return array
     * @throws Exception
     */
    public function testTransactionCreate(array $userResolve): array
    {
        $response = (new Transaction())->create(
            [
                'user' => $userResolve['id'],
                'payment_method' => 'web_money_wmz',
                'price' => 5.99,
                'currency' => 'USD',
                'description' => 'Test',
                'success_url' => 'https://example.com',
                'fail_url' => 'https://example.com',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return ['id' => $response->getContent()['id']];
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#get-transaction-by-id
     *
     * @depends testTransactionCreate
     *
     * @param array $transaction
     * @throws Exception
     */
    public function testTransactionStatus(array $transaction): void
    {
        $response = (new Transaction())->status(
            [
                'id' => $transaction['id'],
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-available-payout-types
     *
     * @return array
     * @throws Exception
     */
    public function testPayoutFetchAvailablePayoutTypes(): array
    {
        $response = (new Payout())->fetchAvailablePayoutTypes(
            [],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return $response->getContent();
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-payout-parameters
     *
     * @depends testPayoutFetchAvailablePayoutTypes
     *
     * @param array $availablePayoutTypes
     * @return array
     * @throws Exception
     */
    public function testPayoutFetchPayoutParameters(array $availablePayoutTypes): array
    {
        $response = (new Payout())->fetchPayoutParameters(
            [
                'type' => $availablePayoutTypes['types'][0]['id'],
                'account' => 553691,
                'currency' => 'RUB',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());

        return $response->getContent();
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-payout
     *
     * @depends testPayoutFetchAvailablePayoutTypes
     *
     * @param array $availablePayoutTypes
     * @throws Exception
     */
    public function testPayoutCreate(array $availablePayoutTypes): void
    {
        $responseToken = (new Card())->tokenCreate(
            [
                'number' => '4012001037141112',
                'expiration_month' => '4',
                'expiration_year' => '2022',
                'security_code' => '123',
            ],
            [
                'public_key' => Config::getInstance()->tests['public_key'],
            ]
        );

        $requestParameters = [
            'type' => $availablePayoutTypes['types'][0]['id'],
            'amount' => 10,
            'currency' => 'RUB',
            'account' => 553691,
            'description' => 'payout',
            'phone' => '77777777777',
            'country' => 'RU',
            'birthDate' => '15.02.1980',
            'birthPlace' => 'Moscow',
            'countryOfResidence' => 'RU',
            'documentType' => 'id',
            'documentIssuer' => 'test',
            'documentSeries' => 'AD903876K098',
            'documentNumber' => 'LKHJKJH768KJLHK897',
            'documentIssuedAt' => '15.02.2020',
            'documentValidUntil' => '15.02.2030',
            'beneficiaryFirstName' => 'First Name',
            'beneficiaryLastName' => 'Last Name',
            'countryOfCitizenship' => 'RU',
            'cardToken' => $responseToken->getContent()['id'],
        ];

        $response = (new Payout())->create(
            $requestParameters,
            [
                'public_key' => Config::getInstance()->tests['public_key'],
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());
        $this->assertEquals(true, $response->getContent()['success']);
    }
}
