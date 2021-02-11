<?php

namespace Vepay\Cauri\Tests\Unit\Resource;

use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Card;
use Vepay\Cauri\Resource\User;
use Vepay\Cauri\Tests\Mock\Response\MockPayinCardAuthenticateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockCardTokenCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockPayinCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockUserRecurringCancelResponse;
use Vepay\Cauri\Tests\Mock\Response\MockUserRecurringSettingsChangeResponse;
use Vepay\Cauri\Tests\Mock\Response\MockUserResolveResponse;
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
        $card = new Card();
        $response = new MockCardTokenCreateResponse();
        $card->mock('tokenCreate', $response);
        $receivedResponse = $card->tokenCreate();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     */
    public function testMockPayinCardAuthenticate(): void
    {
        $payin = new Payin();
        $response = new MockPayinCardAuthenticateResponse();
        $payin->mock('cardAuthenticate', $response);
        $receivedResponse = $payin->cardAuthenticate();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#resolve-a-user
     */
    public function testMockUserResolve(): void
    {
        $user = new User();
        $response = new MockUserResolveResponse();
        $user->mock('resolve', $response);
        $receivedResponse = $user->resolve();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     */
    public function testMockUserChangeRecurringSettings(): void
    {
        $user = new User();
        $response = new MockUserRecurringSettingsChangeResponse();
        $user->mock('recurringSettingsChange', $response);
        $receivedResponse = $user->recurringSettingsChange();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#cancel-recurring
     */
    public function testMockUserCancelRecurring(): void
    {
        $user = new User();
        $response = new MockUserRecurringCancelResponse();
        $user->mock('recurringCancel', $response);
        $receivedResponse = $user->recurringCancel();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(201, $receivedResponse->getStatus());
    }
}
