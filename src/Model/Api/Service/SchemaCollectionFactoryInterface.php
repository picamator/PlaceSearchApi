<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Create Schema collection
 */
interface SchemaCollectionFactoryInterface
{
    /**
     * Create
     *
     * @return CollectionInterface
     */
    public function create() : CollectionInterface;
}
