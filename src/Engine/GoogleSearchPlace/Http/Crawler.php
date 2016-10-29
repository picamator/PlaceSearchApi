<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Http;

use Picamator\PlaceSearchApi\Model\Api\Http\ClientInterface;
use Picamator\PlaceSearchApi\Model\Api\Http\CrawlerInterface;
use Picamator\PlaceSearchApi\Model\Exception\CrawlerException;
use Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException;

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
        $url = http_build_query($query);

        try {
            $response = $this->client->get($url);
            $body = $response->getBody();

            // http status
            if ($response->getStatusCode() !== 200) {
                throw new CrawlerException(
                    sprintf('Invalid response status code "%d", body "%s"', $response->getStatusCode(), serialize($body))
                );
            }

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
}
