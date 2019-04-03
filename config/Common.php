<?php
namespace Chanshige\AuraDi\Config;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Chanshige\Backlog\Factory\ResourceFactory;
use Chanshige\Backlog\Http\Request;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Resource\Issues;
use Chanshige\Backlog\Resource\Space;
use Chanshige\Backlog\Resource\Users;
use Chanshige\SimpleCurl\Curl;
use Chanshige\SimpleCurl\CurlInterface;

/**
 * Class Common
 *
 * @package Chanshige\AuraDi\Config
 */
final class Common extends ContainerConfig
{
    /**
     * {@inheritdoc}
     */
    public function define(Container $di)
    {
        $di->types[CurlInterface::class] = $di->lazyNew(Curl::class);
        $di->types[RequestInterface::class] = $di->lazyNew(Request::class);

        $di->params[ResourceFactory::class]['map'] = [
            'issues' => $di->newFactory(Issues::class),
            'space' => $di->newFactory(Space::class),
            'users' => $di->newFactory(Users::class),
        ];
    }
}
