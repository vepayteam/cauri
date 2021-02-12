<?php

namespace Vepay\Cauri\Tests\Features\Resource;

use Exception;
use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Card;
use Vepay\Cauri\Resource\Payin;
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
                'attr_test' => 'test',
//                'recurring' => 1,
//                'recurring_interval' => 15,
//                'recurring_trial' => 10,
//                'attr_test1' => 'test1',
//                'attr_test2' => 'test2',
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

            $this->assertEquals(201, $response->getStatus());
        } catch (Exception $exception) {
            $this->assertEquals(403, $exception->getCode());
            $this->assertStringContainsString('Recurring is disabled for requested user.', $exception->getMessage());
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
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @throws Exception
     */
    public function testPayinWithCardCreate(): void
    {
        $response = (new Payin())->create(
            [
                'project' => time(),
                'user' => [
                    'id' => time(),
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
                'card' => [
                    'number' => '5444870724493746',
                    'expiration_month' => '4',
                    'expiration_year' => '2022',
                    'security_code' => '123',
                    'holder' => 'Firstname Secondname',
                ],
                'attr_test1' => '',
                'attr_test2' => 'asd',
                'attr_test3' => null,
                'attr_test4' => 0,
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     *
     * @depends testUserResolve
     * @depends testPayinWithCardTokenCreate
     *
     * @param array $userResolve
     * @param array $payin
     * @throws Exception
     */
    public function testCardAuthenticate(array $userResolve, array $payin): void
    {
        $response = (new Card())->authenticate(
            [
                'project' => $userResolve['projectId'],
                'PaRes' => $payin['acs']['parameters']['PaReq'],
                'MD' => $payin['acs']['parameters']['MD'],
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
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
        $response = (new Card())->manualRecurring(
            [
                'project' => $userResolve['projectId'],
                'user' => $userResolve['id'],
                'price' => 5.99,
                'currency' => 'USD',
                'order_id' => '12345',
                'description' => 'My custom description.',
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#reverse-a-payment
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testRefundCreate(array $userResolve): void
    {
        $response = (new Refund())->create(
            [
                'project' => $userResolve['projectId'],
                'id' => 122612357431149845,
                'amount' => 0.01,
                'comment' => 'Suspected fraud.',
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-new-transaction
     *
     * @depends testUserResolve
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testTransactionCreate(array $userResolve): void
    {
        $response = (new Transaction())->create(
            [
                'project' => $userResolve['projectId'],
                'user' => $userResolve['id'],
                'payment_method' => 'web_money_wmz',
                'price' => 5.99,
                'currency' => 'USD',
                'description' => 'Test',
                'success_url' => 'https://example.com',
                'fail_url' => 'https://example.com',
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
    }
}
