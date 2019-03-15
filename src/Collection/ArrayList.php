<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Collection;

use ArrayIterator;

/**
 * Class ArrayList
 *
 * @package Chanshige\Backlog\Collection
 */
class ArrayList extends ArrayIterator
{
    /**
     * ArrayList constructor.
     *
     * @param iterable $input
     */
    public function __construct(iterable $input = [])
    {
        parent::__construct($input, ArrayIterator::STD_PROP_LIST);
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function add($value)
    {
        parent::append($value);

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     * @return $this
     */
    public function set(string $key, $value)
    {
        parent::offsetSet($key, $value);

        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function get(string $key)
    {
        return parent::offsetGet($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool
    {
        return parent::offsetExists($key);
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return parent::count();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return iterator_to_array($this);
    }
}
