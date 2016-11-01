<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;

/**
 * Object value for Location
 *
 * @codeCoverageIgnore
 */
class Location implements LocationInterface , \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param string $latitude
     * @param string $longitude
     */
    public function __construct(string $latitude, string $longitude)
    {
        $this->data = ['lat' => $latitude, 'lng' => $longitude];
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitude() : float
    {
        return $this->data['lat'];
    }

    /**
     * {@inheritdoc}
     */
    public function getLongitude() : float
    {
        return $this->data['lng'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return $this->data;
    }
}
