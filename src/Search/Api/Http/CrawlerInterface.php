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
     * @throws CrawlerException
     */
    public function get(array $query) : array;
}
