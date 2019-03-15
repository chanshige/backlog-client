<?php
declare(strict_types=1);

namespace Chanshige\Backlog;

use Aura\Di\ContainerBuilder;
use Aura\Di\Exception;
use Exception\BacklogClientException;

/**
 * Class Factory
 *
 * @package Chanshige\Backlog
 */
final class Factory
{
    /**
     * Return a new instance.
     *
     * @param string $name       instance name.
     * @param array  $params     constructor inject
     * @param array  $configured ContainerConfig classes
     * @param bool   $resolve    auto-resolver
     * @return object
     */
    public function newInstance(
        string $name,
        array $params = [],
        $configured = [\Chanshige\AuraDi\Config\Common::class],
        $resolve = ContainerBuilder::AUTO_RESOLVE
    ) {
        try {
            return $this->newContainer($configured, $resolve)
                ->newInstance($name, $params);
        } catch (Exception $e) {
            throw new BacklogClientException($e->getMessage());
        }
    }

    /**
     * Creates and returns a new Container for the project.
     *
     * @param array $configClasses
     * @param bool  $autoResolve Use the auto-resolver (default:false)
     * @return \Aura\Di\Container
     * @throws BacklogClientException
     */
    public function newContainer($configClasses = [], $autoResolve = false)
    {
        try {
            return (new ContainerBuilder)->newConfiguredInstance($configClasses, $autoResolve);
        } catch (Exception $e) {
            throw new BacklogClientException($e->getMessage());
        }
    }
}
