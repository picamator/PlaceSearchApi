<?php
namespace Picamator\PlaceSearchApi\Model\Api\Http;

use Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

/**
 * Http client
 */
interface ClientInterface
{
    /**
     * Provide GET request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     */
    public function get(string $url, array $options = []): ResponseInterface;

    /**
     * Provide DELETE request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     */
    public function delete(string $url, array $options = []): ResponseInterface;

    /**
     * Provide HEAD request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     */
    public function head(string $url, array $options = []): ResponseInterface;

    /**
     * Provide OPTIONS request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     */
    public function options(string $url, array $options = []): ResponseInterface;

    /**
     * Provide PATCH request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     */
    public function patch(string $url, array $options = []): ResponseInterface;

    /**
     * Provide POST request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     */
    public function post(string $url, array $options = []): ResponseInterface;

    /**
     * Provide PUT request
     *
     * @param string    $url
     * @param array     $options
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     */
    public function put(string $url, array $options = []): ResponseInterface;
}
