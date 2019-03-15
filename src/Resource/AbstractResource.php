<?php
namespace Chanshige\Backlog\Resource;

use Chanshige\Backlog\Component\Parameters;
use Chanshige\Backlog\Interfaces\RequestInterface;
use Chanshige\Backlog\Interfaces\UriInterface;

/**
 * Class AbstractResource
 *
 * @package Chanshige\Backlog\Resource
 */
abstract class AbstractResource extends Parameters
{
    /** @var UriInterface */
    private $uri;

    /** @var RequestInterface */
    private $request;

    /** @var iterable */
    private $params;

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
        $this->uri = $uri;
        $this->request = $request;
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
        $clone->params = $params;

        return $clone;
    }

    /**
     * GET Request.
     *
     * @return mixed
     */
    public function get()
    {
        if (is_iterable($this->params)) {
            $this->uri = $this->uri->withQuery($this->params);
        }

        return $this->invoke()->get();
    }

    /**
     * Invoke request.
     *
     * @param mixed $parameters
     * @param array $header
     * @return RequestInterface
     */
    private function invoke($parameters = null, $header = []): RequestInterface
    {
        return $this->request->__invoke(
            (string)$this->uri->withPath($this->modifyPath()),
            $parameters,
            $header
        );
    }

    /**
     * @return string
     */
    private function modifyPath()
    {
        return implode("/", $this->getIterator()->toArray());
    }
}
