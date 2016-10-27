<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LinkInterface;

/**
 * Builder for Link collection
 */
interface LinkCollectionBuilderInterface
{
    /**
     * Add link to collection
     *
     * @param LinkInterface $link
     *
     * @return LinkCollectionBuilderInterface
     */
    public function addLink(LinkInterface $link) : self;

    /**
     * Build
     *
     * @return CollectionInterface
     */
    public function build() : CollectionInterface;
}
