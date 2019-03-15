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

    /** @var ArrayList */
    private $params;

    /**
     * Parameters constructor.
     *
     * @param array $input
     */
    public function __construct(array $input = [])
    {
        array_unshift($input, $this->name);
        $this->params = new ArrayList($input);
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
        $this->params->add($name);
        if (isset($args[0])) {
            $this->params->add($args[0]);
        }

        return $this;
    }

    /**
     * @return ArrayList
     */
    public function getIterator()
    {
        return $this->params;
    }
}
