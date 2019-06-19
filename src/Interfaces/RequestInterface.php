<?php
namespace Chanshige\Backlog\Interfaces;

use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Interface RequestInterface
 *
 * @package Chanshige\Backlog\Interfaces
 */
interface RequestInterface
{
    /** @var string HTTP Method */
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';

    /**
     * Requests an HTTP resource.
     *
     * @param string $method
     * @param string $url
     * @param array  $options
     * @return ResponseInterface
     */
    public function __invoke(string $method, string $url, array $options = []): ResponseInterface;

    /**
     * @param ResponseInterface|ResponseInterface[]|iterable $responses
     * @param float                                          $timeout
     * @return mixed
     */
    public function stream($responses, float $timeout = 0);

    /**
     * @param string $token
     * @return RequestInterface
     */
    public function withAuthBearer(string $token): RequestInterface;

    /**
     * @param array $queries
     * @return RequestInterface
     */
    public function withQuery(array $queries): RequestInterface;

    /**
     * @param mixed $contents
     * @return RequestInterface
     */
    public function withBody($contents): RequestInterface;

    /**
     * @param array $headers
     * @return RequestInterface
     */
    public function withHeaders(array $headers): RequestInterface;
}
