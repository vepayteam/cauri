<?php

namespace Vepay\Cauri\Client\Middleware;

use Closure;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Vepay\Gateway\Client\Middleware\MiddlewareInterface;
use Vepay\Gateway\Config;

/**
 * Class ProjectBody
 * @package Vepay\Cauri\Client\Middleware
 */
class ProjectBody implements MiddlewareInterface
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
            $parameters = json_decode($request->getBody()->getContents(), true);
            $parameters['project'] = $options['_options']['public_key'];

            Config::getInstance()->logger->trace('Add project: ' . $parameters['project'], __CLASS__);

            $request = Utils::modifyRequest(
                $request,
                ['body' => Utils::streamFor(json_encode($parameters))]
            );

            return $handler($request, $options);
        };
    }
}