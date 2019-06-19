<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Resource;

use Chanshige\Backlog\Collection\Path;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Interfaces\UriInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class AbstractResource
 *
 * @package Chanshige\Backlog\Resource
 */
abstract class AbstractResource extends Path
{
    /** @var RequestInterface */
    private $request;

    /** @var UriInterface */
    private $uri;

    /** @var array */
    private $parameters = [];

    /**
     * AbstractResource constructor.
     *
     * @param array            $input
     * @param UriInterface     $uri
     * @param RequestInterface $request
     */
    public function __construct(
        array $input,
        UriInterface $uri,
        RequestInterface $request
    ) {
        parent::__construct($input);
        $this->request = $request;
        $this->uri = $uri->withPath($this->buildPath());
    }

    /**
     * Return an instance with params.
     *
     * @param iterable $params
     * @return AbstractResource
     */
    public function withParameters(iterable $params)
    {
        $clone = clone $this;
        $clone->parameters = $params instanceof \Iterator ?
            iterator_to_array($params) : $params;

        return $clone;
    }

    /**
     * Get.
     *
     * @return ResponseInterface
     */
    public function get()
    {
        if (count($this->parameters) > 0) {
            $request = $this->request->withQuery($this->parameters);

            return $request(RequestInterface::GET, (string)$this->uri);
        }

        return ($this->request)(RequestInterface::GET, (string)$this->uri);
    }

    /**
     * Post.
     *
     * @return ResponseInterface
     */
    public function post()
    {
        $request = $this->request->withBody($this->parameters);

        return $request(RequestInterface::POST, (string)$this->uri);
    }

    /**
     * Put.
     *
     * @return ResponseInterface
     */
    public function put()
    {
        $request = $this->request->withBody($this->parameters);

        return $request(RequestInterface::PUT, (string)$this->uri);
    }

    /**
     * Patch.
     *
     * @return ResponseInterface
     */
    public function patch()
    {
        $request = $this->request->withBody($this->parameters);

        return $request(RequestInterface::PATCH, (string)$this->uri);
    }

    /**
     * Delete.
     */
    public function delete()
    {
        // TODO: implements
    }
}
