<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Http;

use Chanshige\Backlog\Interfaces\RequestInterface;
use Exception\BacklogClientException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class Request (Based in Symfony/HttpClient)
 *
 * @package Chanshige\Backlog\Http
 */
final class Request implements RequestInterface
{
    /** @var HttpClientInterface */
    private $client;

    /** @var array $authBearer Authentication */
    private $authBearer = [];

    /** @var array */
    private $headers = [];

    /** @var array */
    private $queries = [];

    /** @var array */
    private $body = [];

    /**
     * Request constructor.
     *
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     * @return ResponseInterface
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            $options = count($options) > 0 ? $options : $this->buildOptions();

            return $this->client->request($method, $url, $options);
        } catch (TransportExceptionInterface $e) {
            throw new BacklogClientException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function stream($responses, float $timeout = null)
    {
        return $this->client->stream($responses, $timeout);
    }

    /**
     * {@inheritDoc]
     */
    public function withAuthBearer(string $token): RequestInterface
    {
        $clone = clone $this;
        $clone->authBearer = [
            'auth_bearer' => $token
        ];

        return $clone;
    }

    /**
     * {@inheritDoc]
     */
    public function withQuery(array $queries): RequestInterface
    {
        $clone = clone $this;
        $clone->queries = [
            'query' => $queries
        ];

        return $clone;
    }

    /**
     * {@inheritDoc]
     */
    public function withBody($contents): RequestInterface
    {
        $clone = clone $this;
        $clone->body = [
            'body' => $contents
        ];

        return $clone;
    }

    /**
     * {@inheritDoc]
     */
    public function withHeaders(array $headers): RequestInterface
    {
        $clone = clone $this;
        $clone->headers = [
            'headers' => $headers
        ];

        return $clone;
    }

    /**
     * Build request options.
     *
     * @return array
     */
    private function buildOptions()
    {
        return array_merge(
            $this->authBearer,
            $this->headers,
            $this->queries,
            $this->body
        );
    }
}
