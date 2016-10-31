<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Http;

use Picamator\PlaceSearchApi\Search\Api\Http\ClientInterface;
use Picamator\PlaceSearchApi\Search\Api\Http\CrawlerInterface;
use Picamator\PlaceSearchApi\Model\Exception\CrawlerException;
use Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

/**
 * Crawler
 */
class Crawler implements CrawlerInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $successStatus = 'OK';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function get(array $query) : array
    {
        $url = '?' . http_build_query($query);

        try {
            $response = $this->client->get($url);

            // http status
            if ($response->getStatusCode() !== 200) {
                throw new CrawlerException(
                    sprintf('Invalid response status code "%d"', $response->getStatusCode())
                );
            }

            $body = $this->getBody($response);

            // status result
            if ($body['status'] !== self::$successStatus) {
                throw new CrawlerException(
                    sprintf('Error in response, body "%s"', serialize($body))
                );
            }

            $result = $body['results'] ?? [];

        } catch (InvalidArgumentException $e) {
            throw new CrawlerException('Invalid arguments to initiate "get" method in client', 0, $e);
        }

        return $result;
    }

    /**
     * Retrieve body
     *
     * @param ResponseInterface $response
     *
     * @return array
     *
     * @throws CrawlerException
     */
    private function getBody(ResponseInterface $response) : array
    {
        $response->getBody()->seek(0);
        $body = $response->getBody()->getContents();
        $body = json_decode($body, true);

        // wrong json format
        if (is_null($body)) {
            throw new CrawlerException(
                sprintf('Cannot decode response body "%s"', json_last_error_msg())
            );
        }

        return $body;
    }
}
