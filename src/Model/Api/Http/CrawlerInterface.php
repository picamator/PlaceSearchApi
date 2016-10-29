<?php
namespace Picamator\PlaceSearchApi\Model\Api\Http;

use Picamator\PlaceSearchApi\Model\Exception\CrawlerException;

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
