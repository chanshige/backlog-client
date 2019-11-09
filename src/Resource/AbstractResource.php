<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Resource;

use Chanshige\Backlog\Collection\PathObject;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Interfaces\UriInterface;
use Exception\BacklogClientException;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Chanshige\Backlog\Collection\ArrayList;
use Traversable;

/**
 * Class AbstractResource
 *
 * @package Chanshige\Backlog\Resource
 */
abstract class AbstractResource extends PathObject
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
        $this->uri = $uri;
    }

    /**
     * Return an instance with params.
     *
     * @param iterable $params
     * @return AbstractResource
     * @throws BacklogClientException
     */
    public function withParameters(iterable $params)
    {
        $itr = $params instanceof Traversable ? $params : new ArrayList($params);
        if (!$itr->valid()) {
            throw new BacklogClientException('The iterable params passed to RequestInterface is empty.');
        }

        $clone = clone $this;
        $clone->parameters = $itr;

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
            return $this->invoke(
                $this->request->withQuery($this->parameters),
                RequestInterface::GET
            );
        }

        return $this->invoke($this->request, RequestInterface::GET);
    }

    /**
     * Post.
     *
     * @return ResponseInterface
     */
    public function post()
    {
        return $this->invoke(
            $this->request->withBody($this->parameters),
            RequestInterface::POST
        );
    }

    /**
     * Put.
     *
     * @return ResponseInterface
     */
    public function put()
    {
        return $this->invoke(
            $this->request->withBody($this->parameters),
            RequestInterface::PUT
        );
    }

    /**
     * Patch.
     *
     * @return ResponseInterface
     */
    public function patch()
    {
        return $this->invoke(
            $this->request->withBody($this->parameters),
            RequestInterface::PATCH
        );
    }

    /**
     * Delete.
     */
    public function delete()
    {
        // TODO: implements
    }

    /**
     * Invoke request.
     *
     * @param RequestInterface $request
     * @param string           $method
     * @return ResponseInterface
     */
    private function invoke($request, $method)
    {
        return $request($method, (string)$this->uri->withPath($this->createPath()));
    }
}
