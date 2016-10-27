<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\BarInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Bar value object
 */
interface BarBuilderInterface
{
    /**
     * Sets identifier
     *
     * @param string $id
     *
     * @return BarBuilderInterface
     */
    public function setId(string $id) : self;

    /**
     * Sets place identifier
     *
     * @param string $placeId
     *
     * @return BarBuilderInterface
     */
    public function setPlaceId(string $placeId) : self;

    /**
     * Sets location
     *
     * @param LocationInterface $location
     *
     * @return BarBuilderInterface
     */
    public function setLocation(LocationInterface $location) : self;

    /**
     * Sets name
     *
     * @param string $name
     *
     * @return BarBuilderInterface
     */
    public function setName(string $name) : self;

    /**
     * Sets icon
     *
     * @param string $icon
     *
     * @return BarBuilderInterface
     */
    public function setIcon(string $icon) : self;

    /**
     * Sets vicinity
     *
     * @param string $vicinity
     *
     * @return BarBuilderInterface
     */
    public function setVicinity(string $vicinity) : self;

    /**
     * Sets scope
     *
     * @param string $scope
     *
     * @return BarBuilderInterface
     */
    public function setScope(string $scope) : self;

    /**
     * Build
     *
     * @return BarInterface
     *
     * @throws RuntimeException;
     */
    public function build() : BarInterface;
}
