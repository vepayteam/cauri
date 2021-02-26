<?php

namespace Vepay\Cauri\Client\Middleware;

use Closure;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Vepay\Gateway\Client\Middleware\MiddlewareInterface;
use Vepay\Gateway\Config;

/**
 * Class Signature
 * @package Vepay\Cauri\Client\Middleware
 */
class Signature implements MiddlewareInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'signature';
    }

    /**
     * @param callable $handler
     * @return Closure
     */
    public function __invoke(callable $handler): Closure
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            switch (strtoupper($request->getMethod()))
            {
                case 'PUT':
                case 'POST':
                    $request = $this->addByPOST($request, $options);
                    break;
                case 'GET':
                    $request = $this->addByGET($request, $options);
                    break;
                default:
                    break;
            }

            return $handler($request, $options);
        };
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return RequestInterface
     */
    private function addByPOST(RequestInterface $request, array $options): RequestInterface
    {
        $parameters = json_decode($request->getBody()->getContents(), true);
        $parameters['signature'] = $this->generateSignature($parameters, $options);

        return Utils::modifyRequest(
            $request,
            ['body' => Utils::streamFor(json_encode($parameters))]
        );
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return RequestInterface
     */
    private function addByGET(RequestInterface $request, array $options): RequestInterface
    {
        parse_str($request->getUri()->getQuery(), $parameters);
        return $request->withUri(
            Uri::withQueryValue($request->getUri(), 'signature', $this->generateSignature($parameters, $options))
        );
    }

    /**
     * @param array $parametersOrigin
     * @param array $options
     * @return string
     */
    private function generateSignature(array $parametersOrigin, array $options): string
    {
        $parameters = [];
        array_walk_recursive($parametersOrigin, function ($item, $key) use (&$parameters) {
            $parameters[] = $item;
        });

        sort($parameters, SORT_STRING);
        $signature = hash_hmac(
            'sha256',
            join('|', $parameters),
            $options['_options']['private_key']
        );
        Config::getInstance()->logger->trace('Add signature: ' . $signature, __CLASS__);

        return $signature;
    }
}