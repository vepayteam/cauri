<?php

namespace Vepay\Cauri\Tests\Features\Resource;

use Exception;
use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Card;
use Vepay\Cauri\Resource\Payin;
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
        $projectId = time();
        $response = (new User())->resolve(
            [
                'project' => $projectId,
                'identifier' => 1,
                'display_name' => 'Example User',
                'email' => 'user@example.com',
                'phone' => '123456789',
                'locale' => 'en',
                'ip' => '127.0.0.1',
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());

        return ['projectId' => $projectId,  'id' => $response->getContent()['id']];
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     *
     * @depends testUserResolveCreate
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testUserRecurringSettingsChange(array $userResolve): void
    {
        $response = (new User())->recurringSettingsChange(
            [
                'project' => $userResolve['projectId'],
                'user' => $userResolve['id'],
                'interval' => '30',
                'price' => 3.50,
                'currency' => 'USD',
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#cancel-recurring
     *
     * @depends testUserResolveCreate
     *
     * @param array $userResolve
     * @throws Exception
     */
    public function testUserRecurringCancel(array $userResolve): void
    {
        $response = (new User())->recurringCancel(
            [
                'project' => $userResolve['projectId'],
                'user' => $userResolve['id'],
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     *
     * @depends testUserResolveCreate
     *
     * @return array
     * @throws Exception
     */
    public function testCardTokenCreate(array $userResolve): array
    {
        $response = (new Card())->tokenCreate(
            [
                'project' => $userResolve['projectId'],
                'number' => '5444870724493746',
                'expiration_month' => '4',
                'expiration_year' => '2022',
                'security_code' => '123',
            ],
        );

        $this->assertEquals(201, $response->getStatus());

        return ['projectId' => $userResolve['projectId'],  'id' => $response->getContent()['id']];
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @depends testCardTokenCreate
     * @depends testUserResolveCreate
     *
     * @param array $userResolve
     * @param array $cardToken
     * @throws Exception
     */
    public function testPayinWithCardTokenCreate(array $userResolve, array $cardToken): void
    {
        $response = (new Payin())->create(
            [
                'project' => $userResolve['projectId'],
                'user' => $userResolve['id'],
                'price' => '0.01',
                'currency' => 'RUB',
                'description' => 'Test Descr',
                'card_token' => $cardToken['id'],
                'attr_test1' => '',
                'attr_test2' => 'asd',
                'attr_test3' => null,
                'attr_test4' => 0,
            ],
            [
                'private_key' => Config::getInstance()->tests['private_key'],
            ]
        );

        $this->assertEquals(201, $response->getStatus());
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

        $this->assertEquals(201, $response->getStatus());
    }
}
