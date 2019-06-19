<?php
declare(strict_types=1);

namespace Chanshige\AuraDi\Config;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Chanshige\Backlog\Factory\ResourceFactory;
use Chanshige\Backlog\Http\Request;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Resource\Issues;
use Chanshige\Backlog\Resource\Space;
use Chanshige\Backlog\Resource\Users;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
        $di->types[HttpClientInterface::class] = $di->lazy([HttpClient::class, 'create']);
        $di->types[RequestInterface::class] = $di->lazyNew(Request::class);

        $di->params[ResourceFactory::class]['map'] = [
            'issues' => $di->newFactory(Issues::class),
            'space' => $di->newFactory(Space::class),
            'users' => $di->newFactory(Users::class),
        ];
    }
}
