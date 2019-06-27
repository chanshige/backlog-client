<?php
declare(strict_types=1);

namespace Chanshige\Backlog;

use Aura\Di\Container;
use Aura\Di\ContainerBuilder;
use Aura\Di\ContainerConfigInterface;
use Chanshige\AuraDi\Config\Common;
use Chanshige\Backlog\Provider\ResourceProvider;
use Exception\BacklogClientException;
use Exception;

/**
 * Class Factory
 *
 * @package Chanshige\Backlog
 */
final class Factory
{
    /** @var ContainerConfigInterface[]|array */
    private $configClasses = [];

    /**
     * Factory constructor.
     *
     * @param array $configClasses A list of ContainerConfig classes to
     *                             instantiate and invoke for configuring the Container.
     */
    public function __construct(array $configClasses = [])
    {
        // container inject
        $this->configClasses = $configClasses ?: [Common::class];
    }

    /**
     * Return a new instance.
     *
     * @param string $spaceUri
     * @param string $apiKey
     * @return object
     */
    public function newInstance(string $spaceUri, string $apiKey)
    {
        try {
            $config = [
                'spaceUri' => $spaceUri,
                'apiKey' => $apiKey
            ];

            return $this->newContainer($this->configClasses, ContainerBuilder::AUTO_RESOLVE)
                ->newInstance(ResourceProvider::class, $config);
        } catch (Exception $e) {
            throw new BacklogClientException($e->getMessage());
        }
    }

    /**
     * Creates and returns a new Container for the project.
     *
     * @param array $configClasses
     * @param bool  $autoResolve Use the auto-resolver (default:false)
     * @return Container
     * @throws BacklogClientException
     */
    public function newContainer(array $configClasses = [], bool $autoResolve = false)
    {
        try {
            return (new ContainerBuilder)->newConfiguredInstance($configClasses, $autoResolve);
        } catch (Exception $e) {
            throw new BacklogClientException($e->getMessage());
        }
    }
}
