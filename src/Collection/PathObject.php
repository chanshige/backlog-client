<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Collection;

/**
 * Class PathObject
 *
 * @package Chanshige\Backlog\Collection
 */
class PathObject
{
    /** @var array */
    protected $name = [];

    /** @var ArrayList */
    private $collection;

    /**
     * PathObject constructor.
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->collection = new ArrayList($this->name);
        if (count($args) > 0) {
            $this->collection->append(array_value_first($args));
        }
    }

    /**
     * @param string $name
     * @param array  $args
     * @return self
     */
    public function __call(string $name, array $args): PathObject
    {
        $clone = clone $this;
        $clone->collection->append($name);
        if (count($args) > 0) {
            $clone->collection->append(array_value_first($args));
        }

        return $clone;
    }

    /**
     * @return string
     */
    protected function createPath(): string
    {
        return implode('/', $this->collection->toArray());
    }
}
