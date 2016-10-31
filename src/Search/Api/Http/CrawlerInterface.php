<?php
namespace Picamator\PlaceSearchApi\Search\Api\Http;

use Picamator\PlaceSearchApi\Search\Exception\CrawlerException;

/**
 * Crawler
 */
Interface CrawlerInterface
{
    /**
     * Provide GET request
     *
     * @param array $query
     *
     * @return array
     *
     * @throws CrawlerExceptionException
     */
    public function get(array $query) : array;
}
