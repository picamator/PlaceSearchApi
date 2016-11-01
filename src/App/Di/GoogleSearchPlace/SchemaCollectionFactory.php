<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Di\GoogleSearchPlace;

use Picamator\PlaceSearchApi\Model\Api\Service\SchemaCollectionFactoryInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Create schema collection
 *
 * @codeCoverageIgnore
 */
class SchemaCollectionFactory
{
    /**
     * Create
     *
     * @param SchemaCollectionFactoryInterface $schemaFactory
     *
     * @return CollectionInterface
     */
    public static function create(SchemaCollectionFactoryInterface $schemaFactory) : CollectionInterface
    {
        return $schemaFactory->create();
    }
}
