<?php

namespace Vepay\Cauri\Tests\Unit\Resource;

use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\CardToken;
use Vepay\Cauri\Tests\Mock\Response\MockCardTokenCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockPayinCreateResponse;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Cauri\Resource\Payin;

class MocksResourceOperationsRequestTest extends TestCase
{
    /**
     * Documentation: https://docs.pa.cauri.com/api/#charge-a-card
     */
    public function testMockPayinCreate(): void
    {
        $payin = new Payin();
        $response = new MockPayinCreateResponse();
        $payin->mock('create', $response);
        $receivedResponse = $payin->create();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-a-token
     */
    public function testMockCardTokenCreate(): void
    {
        $cardToken = new CardToken();
        $response = new MockCardTokenCreateResponse();
        $cardToken->mock('create', $response);
        $receivedResponse = $cardToken->create();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }
}
