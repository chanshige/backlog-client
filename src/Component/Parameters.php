<?php
namespace Chanshige\Backlog\Component;

use Chanshige\Backlog\Collection\ArrayList;

/**
 * Class Parameters
 *
 * @package Chanshige\Backlog\Component
 */
abstract class Parameters
{
    /** @var string */
    protected $name = '';

    /** @var array */
    private $params = [];

    /**
     * Parameters constructor.
     *
     * @param array $input
     */
    public function __construct(array $input = [])
    {
        $this->params = array_merge([$this->name], $input);
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
        $this->params[] = $name;
        if (isset($args[0])) {
            $this->params[] = $args[0];
        }

        return $this;
    }

    /**
     * @return ArrayList
     */
    public function getIterator()
    {
        return new ArrayList($this->params);
    }
}
