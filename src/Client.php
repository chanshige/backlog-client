<?php
declare(strict_types=1);

namespace Chanshige\Backlog;

use Chanshige\Backlog\Factory\ResourceFactory;
use Chanshige\Backlog\Http\Uri;
use Chanshige\Backlog\Resource\Issues;
use Chanshige\Backlog\Resource\Space;
use Chanshige\Backlog\Resource\Users;

/**
 * Class Client
 *
 * @method Issues issues($value = null)
 * @method Space space($value = null)
 * @method Users users($value = null)
 * @package Chanshige\Backlog
 */
final class Client
{
    /** @var ResourceFactory */
    private $resource;

    /** @var string */
    private $spaceUri;

    /** @var string */
    private $apiKey;

    /**
     * Client constructor.
     *
     * @param ResourceFactory $resource
     * @param string          $spaceUri
     * @param string          $apiKey
     */
    public function __construct(
        ResourceFactory $resource,
        string $spaceUri,
        string $apiKey
    ) {
        $this->resource = $resource;
        $this->spaceUri = $spaceUri;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $name
     * @param array  $arguments
     * @return object
     */
    public function __call(string $name, array $arguments)
    {
        return $this->resource->newInstance(
            $name,
            $arguments,
            new Uri($this->spaceUri, $this->apiKey)
        );
    }
}
