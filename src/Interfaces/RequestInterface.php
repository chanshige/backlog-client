<?php
namespace Chanshige\Backlog\Interfaces;

/**
 * Interface RequestInterface
 *
 * @package Chanshige\Backlog\Interfaces
 */
interface RequestInterface
{
    /**
     * Init request.
     *
     * @param string            $url
     * @param string|array|null $parameters
     * @param array             $header
     * @return mixed (send request)
     */
    public function __invoke(string $url, $parameters = null, array $header = []);

    /**
     * Get.
     *
     * @return mixed
     */
    public function get();

    /**
     * Post.
     *
     * @return mixed
     */
    public function post();

    /**
     * Put.
     *
     * @return mixed
     */
    public function put();

    /**
     * Patch.
     *
     * @return mixed
     */
    public function patch();

    /**
     * Delete.
     *
     * @return mixed
     */
    public function delete();
}
