<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Builder for Place collection
 */
interface PlaceCollectionBuilderInterface
{
    /**
     * Add bar to collection
     *
     * @param PlaceInterface $place
     *
     * @return PlaceCollectionBuilderInterface
     */
    public function addPlace(PlaceInterface $place) : self;

    /**
     * Build
     *
     * @return CollectionInterface
     */
    public function build() : CollectionInterface;
}
