<?php

namespace Vepay\Cauri\Tests\Features\Resource;

use Exception;
use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Payout;
use Vepay\Cauri\Tests\InitializationTrait;
use Vepay\Gateway\Config;

class ResourceOperationsRequestTest extends TestCase
{
    use InitializationTrait;

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
        $testCard = $this->getTestCard();

        $requestParameters = [
            'type' => $availablePayoutTypes['types'][0]['id'],
            'amount' => 1,
            'currency' => 'RUB',
            'account' => $testCard['number'],
            'cardExpirationDate' => $testCard['expiration_date'],
            'cardHolder' => $testCard['holder'],
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
