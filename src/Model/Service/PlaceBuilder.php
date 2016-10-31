<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Place value object
 */
class PlaceBuilder implements PlaceBuilderInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @var array
     */
    private $dataValue = [];

    /**
     * @var array
     */
    private $dataRequired = ['id', 'location', 'name'];

    /**
     * @var array
     */
    private $dataKey = ['id', 'placeId', 'location', 'name', 'icon', 'vicinity', 'scope'];

    /**
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'Picamator\PlaceSearchApi\Model\Data\Place'
    ) {
        $this->objectManager    = $objectManager;
        $this->className        = $className;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setId(string $id) : PlaceBuilderInterface
    {
        $this->dataValue['id'] = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setPlaceId(string $placeId) : PlaceBuilderInterface
    {
        $this->dataValue['placeId'] = $placeId;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setLocation(LocationInterface $location) : PlaceBuilderInterface
    {
        $this->dataValue['location'] = $location;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setName(string $name) : PlaceBuilderInterface
    {
        $this->dataValue['name'] = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setIcon(string $icon) : PlaceBuilderInterface
    {
        $this->dataValue['icon'] = $icon;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setVicinity(string $vicinity) : PlaceBuilderInterface
    {
        $this->dataValue['vicinity'] = $vicinity;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setScope(string $scope) : PlaceBuilderInterface
    {
        $this->dataValue['scope'] = $scope;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : PlaceInterface
    {
        // validate
        $dataKey = array_keys($this->dataValue);
        $missedKey = array_diff($this->dataRequired, $dataKey);
        if (!empty($missedKey)) {
            throw new RuntimeException(
                sprintf('Required fields "%s" was not set', implode(', ', $missedKey))
            );
        }

        // build data
        $data = [];
        foreach ($this->dataKey as $item) {
            $data[] = $this->dataValue[$item] ?? null;
        }

        /** @var PlaceInterface $result */
        $result = $this->objectManager->create($this->className, $data);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->dataValue = [];
    }
}
