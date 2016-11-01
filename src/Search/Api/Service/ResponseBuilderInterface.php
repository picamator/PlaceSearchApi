<?php
namespace Picamator\PlaceSearchApi\Search\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface;
use Picamator\PlaceSearchApi\Search\Exception\RuntimeException;

/**
 * Builder for Response data object
 */
interface ResponseBuilderInterface
{
    /**
     * Sets data
     *
     * @param CollectionInterface $data
     *
     * @return ResponseBuilderInterface
     */
    public function setData(CollectionInterface $data) : self;

    /**
     * Sets code
     *
     * @param int $code
     *
     * @return ResponseBuilderInterface
     */
    public function setCode(int $code) : self;

    /**
     * Build
     *
     * @return ResponseInterface
     *
     * @throws RuntimeException
     */
    public function build() : ResponseInterface;
}
