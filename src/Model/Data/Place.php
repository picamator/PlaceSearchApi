<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;

/**
 * Value object for Place
 *
 * @codeCoverageIgnore
 */
class Place implements PlaceInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param string            $id
     * @param string            $placeId
     * @param LocationInterface $location
     * @param string            $name
     * @param string            $icon
     * @param string            $vicinity
     * @param string            $scope
     */
    public function __construct(
        string $id,
        string $placeId,
        LocationInterface $location,
        string $name,
        string $icon,
        string $vicinity,
        string $scope
    ) {
        $this->data = [
            'id'        => $id,
            'placeId'   => $placeId,
            'location'  => $location,
            'name'      => $name,
            'icon'      => $icon,
            'vicinity'  => $vicinity,
            'scope'     => $scope
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId() : string
    {
        return $this->data['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPlaceId() : string
    {
        return $this->data['placeId'];
    }

    /**
     * {@inheritdoc}
     */
    public function getLocation() : LocationInterface
    {
        return $this->data['location'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string
    {
        return $this->data['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function getIcon() : string
    {
        return $this->data['icon'];
    }

    /**
     * {@inheritdoc}
     */
    public function getVicinity() : string
    {
        return $this->data['vicinity'];
    }

    /**
     * {@inheritdoc}
     */
    public function getScope() : string
    {
        return $this->data['scope'];
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
