<?php

namespace Vepay\Cauri\Resource;

use Vepay\Cauri\Client\ClientConfigurator;
use Vepay\Cauri\Client\Request\UserChangeRecurringSettingsRequest;
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
    protected function changeRecurringSettings(array $parameters, array $options): ResponseInterface
    {
        $request = new UserChangeRecurringSettingsRequest($parameters, $options);

        return ClientConfigurator
            ::get()
            ->send($request);
    }
}