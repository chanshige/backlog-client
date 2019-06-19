<?php
declare(strict_types=1);

namespace Chanshige\Backlog\Http;

use Chanshige\Backlog\Interfaces\UriInterface;

/**
 * Class Uri
 *
 * @package Chanshige\Backlog\Http
 */
final class Uri implements UriInterface
{
    /** @var string */
    public $scheme = 'https';

    /** @var int */
    private $port = 443;

    /** @var string */
    public $host = '';

    /** @var string */
    public $path = '';

    /** @var array */
    public $query = [];

    /** @var string */
    public $method = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(string $host, string $apiKey, string $path = '', array $query = [])
    {
        $this->host = $this->filterHost($host);
        $this->path = $this->filterPath($path);
        $this->query = $this->mergeApiKeyToQuery($apiKey, $query);
    }

    /**
     * {@inheritdoc}
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * {@inheritdoc}
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * {@inheritdoc}
     */
    public function withScheme($scheme)
    {
        $clone = clone $this;
        $clone->scheme = $scheme;

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function withPort($port)
    {
        $clone = clone $this;
        $clone->port = $port;

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function withHost($host)
    {
        $clone = clone $this;
        $clone->host = $host;

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function withPath(string $path)
    {
        $clone = clone $this;
        $clone->path = $this->filterPath($path);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function withQuery(iterable $query)
    {
        $clone = clone $this;
        $clone->query = $this->filterQuery($query);

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return "{$this->scheme}://{$this->host}:{$this->port}/{$this->path}" .
            (count($this->query) > 0 ? '?' . http_build_query($this->query) : '');
    }

    /**
     * Merge backlog apiKey to query params.
     *
     * @param string $key
     * @param array  $query
     * @return array
     */
    private function mergeApiKeyToQuery(string $key, array $query): array
    {
        return array_merge(['apiKey' => $key], $query);
    }

    /**
     * @param string $uri
     * @return string
     */
    private function filterHost(string $uri): string
    {
        return rtrim(parse_url($uri, PHP_URL_HOST) ?? $uri, "/");
    }

    /**
     * @param string $path
     * @return string
     */
    private function filterPath(string $path): string
    {
        $path = strlen($path) > 0 ? '/' . $path : '';

        return trim($this->path . $path, "/");
    }

    /**
     * @param iterable $query
     * @return array
     */
    private function filterQuery(iterable $query): array
    {
        return array_merge($this->query, $query);
    }
}
