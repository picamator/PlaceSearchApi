<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface;

/**
 * Builder fo Schema collection
 */
interface SchemaCollectionBuilderInterface
{
    /**
     * Add schema
     *
     * @param SchemaInterface $schema
     *
     * @return SchemaCollectionBuilderInterface
     */
    public function addSchema(SchemaInterface $schema) : self;

    /**
     * Build
     *
     * @return CollectionInterface
     */
    public function build() : CollectionInterface;
}
