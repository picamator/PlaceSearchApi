<?php
namespace Picamator\PlaceSearchApi\Search\Api\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Builder for Error collection
 */
interface ErrorCollectionBuilderInterface
{
    /**
     * Add error
     *
     * @param ErrorInterface $error
     *
     * @return ErrorCollectionBuilderInterface
     */
    public function addError(ErrorInterface $error) : self;

    /**
     * Build
     *
     * @return CollectionInterface
     */
    public function build() : CollectionInterface;
}
