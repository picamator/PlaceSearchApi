<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Http;

use Picamator\PlaceSearchApi\Search\Api\Http\ClientInterface;
use GuzzleHttp\ClientInterface AS GuzzleHttpClientInterface;
use Psr\Http\Message\ResponseInterface;
use Picamator\PlaceSearchApi\Search\Exception\InvalidArgumentException;

/**
 * Http client
 *
 * Wrapper over Guzzle
 * @see http://docs.guzzlephp.org/en/latest/quickstart.html
 *
 * @codeCoverageIgnore
 */
class Client implements ClientInterface
{
    /**
     * @var GuzzleHttpClientInterface
     */
    private $client;

    /**
     * @param GuzzleHttpClientInterface $client
     */
    public function __construct(GuzzleHttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->get($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->delete($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function head(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->head($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function options(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->options($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function patch(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->patch($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->post($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $url, array $options = []): ResponseInterface
    {
        try {
            $result = $this->client->put($url, $options);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Processing 3-rd party exception', 0, $e);
        }

        return $result;
    }
}
