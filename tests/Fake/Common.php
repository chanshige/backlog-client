<?php
namespace Chanshige\Backlog\Fake;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Chanshige\Backlog\Factory\ResourceFactory;
use Chanshige\Backlog\Http\Request;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Resource\Issues;
use Chanshige\Backlog\Resource\Space;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Common
 *
 * @package Chanshige\Backlog\Fake
 */
class Common extends ContainerConfig
{
    /**
     * {@inheritDoc}
     */
    public function define(Container $di)
    {
        $di->types[HttpClientInterface::class] = $di->lazyNew(MockHttpClient::class);
        $di->types[RequestInterface::class] = $di->lazyNew(Request::class);

        $di->params[ResourceFactory::class]['map'] = [
            'issues' => $di->newFactory(Issues::class),
            'space' => $di->newFactory(Space::class),
        ];
    }
}
