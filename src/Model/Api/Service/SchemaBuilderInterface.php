<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Build Schema value object
 */
interface SchemaBuilderInterface
{
    /**
     * Sets source
     *
     * @param string $source
     *
     * @return SchemaBuilderInterface
     */
    public function setSource(string $source) : self;

    /**
     * Sets destination
     *
     * @param string $destination
     *
     * @return SchemaBuilderInterface
     */
    public function setDestination(string $destination) : self;

    /**
     * Sets builder
     *
     * @param string $builder
     *
     * @return SchemaBuilderInterface
     */
    public function setBuilder(string $builder) : self;

    /**
     * Sets schema collection
     *
     * @param CollectionInterface $schemaCollection
     *
     * @return SchemaBuilderInterface
     */
    public function setSchemaCollection(CollectionInterface $schemaCollection) : self;

    /**
     * Build
     *
     * @return SchemaInterface
     *
     * @throws RuntimeException
     */
    public function build() : SchemaInterface;
}
