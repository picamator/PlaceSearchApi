<?php
namespace Picamator\PlaceSearchApi\Search\Api;

use Picamator\PlaceSearchApi\Search\Exception\InvalidArgumentException;

/**
 * Config
 */
interface ConfigInterface
{
    /**
     * Search data over configuration
     *
     * @param array ...$arguments
     *
     * @return mixed all data if no arguments were set
     *
     * @throws InvalidArgumentException
     */
    public function search(...$arguments);
}