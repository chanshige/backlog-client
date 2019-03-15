<?php
namespace Chanshige\Backlog\Interfaces;

/**
 * Interface UriInterface
 *
 * @package Chanshige\Backlog\Interfaces
 */
interface UriInterface
{
    /**
     * Retrieve the scheme component of the URI.
     *
     * @return string
     */
    public function getScheme(): string;

    /**
     * Retrieve the host component of the URI.
     *
     * @return string
     */
    public function getHost(): string;

    /**
     * Retrieve the port component of the URI.
     *
     * @return int
     */
    public function getPort(): int;

    /**
     * Retrieve the path component of the URI.
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * Retrieve the query string of the URI.
     *
     * @return array
     */
    public function getQuery(): array;

    /**
     * Return an instance with the specified scheme.
     *
     * @param $scheme
     * @return self
     */
    public function withScheme($scheme);

    /**
     * Return an instance with the specified host.
     *
     * @param $host
     * @return self
     */
    public function withHost($host);

    /**
     * Return an instance with the specified path.
     *
     * @param integer $port
     * @return self
     */
    public function withPort($port);

    /**
     * Return an instance with the specified path.
     *
     * @param string $path
     * @return self
     */
    public function withPath(string $path);

    /**
     * Return an instance with the specified query.
     *
     * @param iterable $query
     * @return self
     */
    public function withQuery(iterable $query);

    /**
     * Return a string uri
     *
     * @return string
     */
    public function __toString(): string;
}
