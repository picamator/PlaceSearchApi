<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;
use Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Location value object
 */
interface LocationBuilderInterface
{
    /**
     * Sets latitude
     *
     * @param float $latitude [-90, 90]
     *
     * @return LocationBuilderInterface
     *
     * @throws InvalidArgumentException
     */
    public function setLatitude(float $latitude) : self;

    /**
     * Sets longitude
     *
     * @param float $longitude [-180, 180]
     *
     * @return LocationBuilderInterface
     *
     * @throws InvalidArgumentException
     */
    public function setLongitude(float $longitude) : self;

    /**
     * Build
     *
     * @return LocationInterface
     *
     * @throws RuntimeException
     */
    public function build() : LocationInterface;
}
