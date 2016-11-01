<?php
namespace Picamator\PlaceSearchApi\Model\Api\Data;

/**
 * Object value for Schema
 */
interface SchemaInterface
{
    /**
     * Retrieve source
     *
     * @return string
     */
    public function getSource() : string;

    /**
     * Retrieve destination
     *
     * @return string
     */
    public function getDestination() : string;

    /**
     * Retrieve builder class
     *
     * @return string
     */
    public function getBuilder() : string;

    /**
     * Retrieve schema collection for nested mapping
     *
     * @return null | \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface
     */
    public function getSchemaCollection();
}
