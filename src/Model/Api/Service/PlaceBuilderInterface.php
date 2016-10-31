<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Place value object
 */
interface PlaceBuilderInterface
{
    /**
     * Sets identifier
     *
     * @param string $id
     *
     * @return PlaceBuilderInterface
     */
    public function setId(string $id) : self;

    /**
     * Sets place identifier
     *
     * @param string $placeId
     *
     * @return PlaceBuilderInterface
     */
    public function setPlaceId(string $placeId) : self;

    /**
     * Sets location
     *
     * @param LocationInterface $location
     *
     * @return PlaceBuilderInterface
     */
    public function setLocation(LocationInterface $location) : self;

    /**
     * Sets name
     *
     * @param string $name
     *
     * @return PlaceBuilderInterface
     */
    public function setName(string $name) : self;

    /**
     * Sets icon
     *
     * @param string $icon
     *
     * @return PlaceBuilderInterface
     */
    public function setIcon(string $icon) : self;

    /**
     * Sets vicinity
     *
     * @param string $vicinity
     *
     * @return PlaceBuilderInterface
     */
    public function setVicinity(string $vicinity) : self;

    /**
     * Sets scope
     *
     * @param string $scope
     *
     * @return PlaceBuilderInterface
     */
    public function setScope(string $scope) : self;

    /**
     * Build
     *
     * @return PlaceInterface
     *
     * @throws RuntimeException;
     */
    public function build() : PlaceInterface;
}
