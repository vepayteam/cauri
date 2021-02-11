<?php

namespace Vepay\Cauri\Tests\Features\Resource;

use Exception;
use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\CardToken;
use Vepay\Cauri\Resource\Payin;
use Vepay\Cauri\Tests\InitializationTrait;
use Vepay\Gateway\Config;

class ResourceOperationsRequestTest extends TestCase
{
    use InitializationTrait;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     *
     * @return array
     * @throws Exception
     */
    public function testCardTokenCreate(): array
    {
        $transactionId = time();
        $response = (new CardToken())->create(
            [
                'project' => $transactionId,
                'number' => '5444870724493746',
                'expiration_month' => '4',
                'expiration_year' => '2022',
                'security_code' => '123',
            ],
        );

        $this->assertEquals(201, $response->getStatus());

        return ['token' => $response->getContent()['id']];
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     *
     * @depends testCardTokenCreate
     *
     * @param array $cardToken
     * @throws Exception
     */
    public function testPayinWithCardTokenCreate(array $cardToken): void
    {
        $response = (new Payin())->create(
            [
                'project' => time(),
                'user' => '121212112',
                'price' => '0.01',
                'currency' => 'RUB',
                'description' => 'Test Descr',
                'card_token' => $cardToken['token'],
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
                'user' => '121212112',
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
