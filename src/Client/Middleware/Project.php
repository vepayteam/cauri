<?php

namespace Vepay\Cauri\Client\Middleware;

use Closure;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Vepay\Gateway\Client\Middleware\MiddlewareInterface;
use Vepay\Gateway\Config;

/**
 * Class Project
 * @package Vepay\Cauri\Client\Middleware
 */
class Project implements MiddlewareInterface
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
        $parameters['project'] = $options['_options']['public_key'];

        return  Utils::modifyRequest(
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
        return $request->withUri(
            Uri::withQueryValue($request->getUri(), 'project', $options['_options']['public_key'])
        );
    }
}