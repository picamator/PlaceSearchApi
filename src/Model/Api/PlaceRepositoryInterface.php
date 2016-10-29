<?php
namespace Picamator\PlaceSearchApi\Model\Api;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Exception\RepositoryException;

/**
 * Repository for searching places
 */
interface PlaceRepositoryInterface
{
    /**
     * Search
     *
     * @param array $query
     *
     * @return CollectionInterface
     *
     * @throws RepositoryException
     */
    public function search(array $query) : CollectionInterface;
}
