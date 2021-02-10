<?php

namespace Vepay\Cauri\Tests\Unit\Resource;

use PHPUnit\Framework\TestCase;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Cauri\Resource\Payin;
use Vepay\Cauri\Tests\Mock\Response\MockCreatePayinResponse;

class MocksResourceOperationsRequestTest extends TestCase
{
    public function testMockPayinCreate(): void
    {
        $payin = new Payin();
        $response = new MockCreatePayinResponse();
        $payin->mock('create', $response);
        $receivedResponse = $payin->create();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }
}
