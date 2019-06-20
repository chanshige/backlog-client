<?php
namespace Chanshige\Backlog\Provider;

use Chanshige\Backlog\Factory\ResourceFactory;
use Chanshige\Backlog\Http\Uri;
use Chanshige\Backlog\Resource\Issues;
use Chanshige\Backlog\Resource\Space;
use Chanshige\Backlog\Resource\Users;

/**
 * Class ResourceProvider
 *
 * @method Issues issues($value = null)
 * @method Space space($value = null)
 * @method Users users($value = null)
 * @package Chanshige\Backlog\Provider
 */
final class ResourceProvider
{
    /** @var string */
    private const API_VERSION = 'api/v2';

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
     * Call resource object.
     *
     * @param string $name
     * @param array  $args
     * @return object
     */
    public function __call(string $name, array $args)
    {
        return $this->resource->newInstance(
            $name,
            $args,
            new Uri($this->spaceUri, $this->apiKey, self::API_VERSION)
        );
    }
}
