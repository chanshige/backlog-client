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
    private $http;

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
        $this->http = $request;
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
     * GET request.
     *
     * @return ResponseInterface
     */
    public function get()
    {
        if (is_array($this->parameters) && count($this->parameters) > 0) {
            return $this->http->withQuery($this->parameters)
                ->request(RequestInterface::GET, (string)$this->uri);
        }

        return $this->http->request(RequestInterface::GET, (string)$this->uri);
    }

    /**
     * Post request.
     *
     * @return ResponseInterface
     */
    public function post()
    {
        return $this->http->withBody($this->parameters)
            ->request(RequestInterface::POST, (string)$this->uri);
    }

    public function put()
    {
        // TODO: implements
    }

    public function patch()
    {
        // TODO: implements
    }

    public function delete()
    {
        // TODO: implements
    }
}
