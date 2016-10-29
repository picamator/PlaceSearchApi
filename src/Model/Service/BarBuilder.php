<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\BarInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\BarBuilderInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Bar value object
 */
class BarBuilder implements BarBuilderInterface
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
        string $className = 'Picamator\PlaceSearchApi\Model\Data\Bar'
    ) {
        $this->objectManager    = $objectManager;
        $this->className        = $className;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setId(string $id) : BarBuilderInterface
    {
        $this->dataValue['id'] = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setPlaceId(string $placeId) : BarBuilderInterface
    {
        $this->dataValue['placeId'] = $placeId;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setLocation(LocationInterface $location) : BarBuilderInterface
    {
        $this->dataValue['location'] = $location;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setName(string $name) : BarBuilderInterface
    {
        $this->dataValue['name'] = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setIcon(string $icon) : BarBuilderInterface
    {
        $this->dataValue['icon'] = $icon;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setVicinity(string $vicinity) : BarBuilderInterface
    {
        $this->dataValue['vicinity'] = $vicinity;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setScope(string $scope) : BarBuilderInterface
    {
        $this->dataValue['scope'] = $scope;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : BarInterface
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

        /** @var BarInterface $result */
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
