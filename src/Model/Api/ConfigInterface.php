<?php
namespace Picamator\PlaceSearchApi\Model\Api;

/**
 * Configuration
 */
interface ConfigInterface
{
    /**
     * Search data over configuration
     *
     * @param array ...$arguments
     *
     * @return mixed
     */
    public function search(...$arguments);
}