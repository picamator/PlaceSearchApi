<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\LocationBuilderInterface;
use Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Location value object
 */
class LocationBuilder implements LocationBuilderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var int
     */
    private static $scale = 6;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'Picamator\PlaceSearchApi\Model\Data\Location'
    ) {
        $this->objectManager    = $objectManager;
        $this->className        = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function setLatitude(float $latitude) : LocationBuilderInterface
    {
        $lat = (string)$latitude;
        if (bccomp($lat, '90', self::$scale) === 1 || bccomp($lat, '-90', self::$scale) === -1) {
            throw new InvalidArgumentException('Invalid latitude. Please choose value in range [-90, 90]');
        }

        $this->latitude = $latitude;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLongitude(float $longitude) : LocationBuilderInterface
    {
        $lng = (string)$longitude;
        if (bccomp($lng, '180', self::$scale) === 1 || bccomp($lng, '-180', self::$scale) === -1) {
            throw new InvalidArgumentException('Invalid longitude. Please choose value in range [-180, 180]');
        }

        $this->longitude = $longitude;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : LocationInterface
    {
        if (is_null($this->latitude) || is_null($this->longitude)) {
            throw new RuntimeException('Required fields "latitude or longitude" was not set');
        }

        /** @var LocationInterface $result */
        $result = $this->objectManager->create($this->className, [$this->latitude, $this->longitude]);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->latitude = null;
        $this->longitude = null;
    }
}
