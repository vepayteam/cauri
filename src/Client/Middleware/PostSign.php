<?php

namespace Vepay\Cauri\Client\Middleware;

use Closure;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Vepay\Gateway\Client\Middleware\MiddlewareInterface;
use Vepay\Gateway\Config;

class PostSign implements MiddlewareInterface
{
    public function getName(): string
    {
        return 'postSign';
    }

    public function __invoke(callable $handler): Closure
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            $parametersOrigin = json_decode($request->getBody()->getContents(), true);
            $parameters = $parametersOrigin;
            sort($parameters, SORT_STRING);
            $parametersOrigin['signature'] = hash_hmac(
                'sha256',
                join('|', $parameters),
                $options['_options']['private_key']
            );

            Config::getInstance()->logger->trace('Add signature: ' . $parametersOrigin['signature'], __CLASS__);

            $request = Utils::modifyRequest(
                $request,
                ['body' => Utils::streamFor(json_encode($parametersOrigin))]
            );

            return $handler($request, $options);
        };
    }
}