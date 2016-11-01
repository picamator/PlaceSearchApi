<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Create Collection
 */
interface CollectionFactoryInterface
{
    /**
     * Create
     *
     * @param string    $type
     * @param array     $data
     *
     * @return CollectionInterface
     */
    public function create(string $type, array $data) : CollectionInterface;
}
