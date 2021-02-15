<?php

namespace Vepay\Cauri\Tests\Unit\Resource;

use PHPUnit\Framework\TestCase;
use Vepay\Cauri\Resource\Card;
use Vepay\Cauri\Resource\Payout;
use Vepay\Cauri\Resource\Refund;
use Vepay\Cauri\Resource\Transaction;
use Vepay\Cauri\Resource\User;
use Vepay\Cauri\Tests\Mock\Response\MockCardAuthenticateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockCardManualRecurringResponse;
use Vepay\Cauri\Tests\Mock\Response\MockCardTokenCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockPayinCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockPayoutFetchAvailablePayoutTypesResponse;
use Vepay\Cauri\Tests\Mock\Response\MockPayoutFetchPayoutParametersResponse;
use Vepay\Cauri\Tests\Mock\Response\MockTransactionCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockRefundCreateResponse;
use Vepay\Cauri\Tests\Mock\Response\MockTransactionStatusResponse;
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
        $this->assertEquals(200, $receivedResponse->getStatus());
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
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#authenticate-a-card
     */
    public function testMockCardAuthenticate(): void
    {
        $card = new Card();
        $response = new MockCardAuthenticateResponse();
        $card->mock('authenticate', $response);
        $receivedResponse = $card->authenticate();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#manual-recurring
     */
    public function testMockCardManualRecurring(): void
    {
        $card = new Card();
        $response = new MockCardManualRecurringResponse();
        $card->mock('manualRecurring', $response);
        $receivedResponse = $card->manualRecurring();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
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
        $this->assertEquals(200, $receivedResponse->getStatus());
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
        $this->assertEquals(200, $receivedResponse->getStatus());
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
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#reverse-a-payment
     */
    public function testMockRefundCreate(): void
    {
        $refund = new Refund();
        $response = new MockRefundCreateResponse();
        $refund->mock('create', $response);
        $receivedResponse = $refund->create();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#create-new-transaction
     */
    public function testMockTransactionCreate(): void
    {
        $transaction = new Transaction();
        $response = new MockTransactionCreateResponse();
        $transaction->mock('create', $response);
        $receivedResponse = $transaction->create();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#get-transaction-by-id
     */
    public function testMockTransactionStatus(): void
    {
        $transaction = new Transaction();
        $response = new MockTransactionStatusResponse();
        $transaction->mock('status', $response);
        $receivedResponse = $transaction->status();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-available-payout-types
     */
    public function testMockPayoutFetchAvailablePayoutTypes(): void
    {
        $payout = new Payout();
        $response = new MockPayoutFetchAvailablePayoutTypesResponse();
        $payout->mock('fetchAvailablePayoutTypes', $response);
        $receivedResponse = $payout->fetchAvailablePayoutTypes();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#fetch-payout-parameters
     */
    public function testMockPayoutFetchPayoutParameters(): void
    {
        $payout = new Payout();
        $response = new MockPayoutFetchPayoutParametersResponse();
        $payout->mock('fetchPayoutParameters', $response);
        $receivedResponse = $payout->fetchPayoutParameters();

        $this->assertInstanceOf(ResponseInterface::class, $receivedResponse);
        $this->assertSame($response, $receivedResponse);
        $this->assertEquals(200, $receivedResponse->getStatus());
    }
}
