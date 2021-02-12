<?php

namespace Vepay\Cauri\Client\Middleware;

use Closure;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Vepay\Gateway\Client\Middleware\MiddlewareInterface;
use Vepay\Gateway\Config;

/**
 * Class ProjectQuery
 * @package Vepay\Cauri\Client\Middleware
 */
class ProjectQuery implements MiddlewareInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'project';
    }

    /**
     * @param callable $handler
     * @return Closure
     */
    public function __invoke(callable $handler): Closure
    {
        return function (RequestInterface $request, array $options) use ($handler) {

            Config::getInstance()->logger->trace('Add project: ' . $options['_options']['public_key'], __CLASS__);

            $request = Utils::modifyRequest(
                $request,
                ['query' => $request->getUri()->getQuery() . '&project=' . $options['_options']['public_key']]
            );

            return $handler($request, $options);
        };
    }
}