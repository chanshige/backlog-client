<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Collection;

/**
 * Class Queries
 *
 * @package Chanshige\Backlog\Collection
 */
abstract class Path
{
    /** @var string */
    protected $name = '';

    /** @var ArrayList */
    private $path;

    /**
     * Parameters constructor.
     *
     * @param array $input
     */
    public function __construct(array $input = [])
    {
        $this->path = new ArrayList([$this->name]);
        if (isset($input[0])) {
            $this->path->append($input[0]);
        }
    }

    /**
     * Add param.
     *
     * @param string $name
     * @param array  $args
     * @return $this
     */
    public function __call(string $name, array $args)
    {
        $this->path->append($name);
        if (isset($args[0])) {
            $this->path->append($args[0]);
        }

        return $this;
    }

    /**
     * @return ArrayList
     */
    public function getIterator()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function buildPath()
    {
        return implode("/", $this->path->toArray());
    }
}
