<?php
namespace Chanshige\Backlog\Factory;

use Chanshige\Backlog\Collection\ArrayList;
use Chanshige\Backlog\Interfaces\UriInterface;
use Exception\BacklogClientException;

/**
 * Class ResourceFactory
 *
 * @package Chanshige\Backlog\Factory
 */
final class ResourceFactory
{
    /** @var iterable */
    private $map;

    /**
     * ResourceFactory constructor.
     *
     * @param iterable $map
     */
    public function __construct(iterable $map = [])
    {
        $this->map = new ArrayList($map);
    }

    /**
     * Return an api resource instance.
     *
     * @param string       $name
     * @param array        $params
     * @param UriInterface $uri
     * @return object
     */
    public function newInstance(string $name, array $params, UriInterface $uri)
    {
        if (!$this->map->exists($name)) {
            throw new BacklogClientException("Oops!! resource name:{$name} is undefined.");
        }
        /** @var \Aura\Di\Injection\Factory $factory */
        $factory = $this->map->get($name);

        return $factory($params, $uri);
    }

    /**
     * Return an resource class map.
     *
     * @return string
     */
    public function __toString(): string
    {
        return var_export($this->map->toArray(), true);
    }
}
