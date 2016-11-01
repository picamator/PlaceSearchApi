<?php
namespace Picamator\PlaceSearchApi\Model\Api;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Map data from 3-rd party service to application one
 */
interface MapperInterface
{
    /**
     * Map
     *
     * @param CollectionInterface   $schema
     * @param array                 $data
     *
     * @return mixed
     *
     * @throws RuntimeException
     */
    public function map(CollectionInterface $schema, array $data);
}
