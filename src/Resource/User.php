<?php

namespace Vepay\Cauri\Resource;

use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\UserRecurringCancelRequest;
use Vepay\Cauri\Client\Request\UserRecurringSettingsChangeRequest;
use Vepay\Cauri\Client\Request\UserResolveRequest;
use Vepay\Gateway\Client\Response\ResponseInterface;
use Vepay\Gateway\Resource\MockBehavior;

/**
 * Class User
 * @package Vepay\Cauri\Resource
 */
class User extends AbstractResource
{
    use MockBehavior;

    /**
     * Documentation: https://docs.pa.cauri.com/api/#resolve-a-user
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws \Exception
     */
    protected function resolve(array $parameters, array $options): ResponseInterface
    {
        $request = new UserResolveRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#change-recurring-settings
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws \Exception
     */
    protected function recurringSettingsChange(array $parameters, array $options): ResponseInterface
    {
        $request = new UserRecurringSettingsChangeRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }

    /**
     * Documentation: https://docs.pa.cauri.com/api/#cancel-recurring
     *
     * @param array $parameters
     * @param array $options
     * @return ResponseInterface
     * @throws \Exception
     */
    protected function recurringCancel(array $parameters, array $options): ResponseInterface
    {
        $request = new UserRecurringCancelRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}