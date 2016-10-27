<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\BarInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Builder for Bar collection
 */
interface BarCollectionBuilderInterface
{
    /**
     * Add bar to collection
     *
     * @param BarInterface $bar
     *
     * @return BarCollectionBuilderInterface
     */
    public function addBar(BarInterface $bar) : self;

    /**
     * Build
     *
     * @return CollectionInterface
     */
    public function build() : CollectionInterface;
}
