<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\BarInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\BarCollectionBuilderInterface;

/**
 * Builder for Bar collection
 *
 * @codeCoverageIgnore
 */
class BarCollectionBuilder implements BarCollectionBuilderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $type = 'Picamator\PlaceSearchApi\Model\Api\Data\BarInterface';

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
    private $data = [];

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'Picamator\PlaceSearchApi\Model\Data\Collection'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function addBar(BarInterface $bar) : BarCollectionBuilderInterface
    {
        $this->data[] = $bar;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : CollectionInterface
    {
        /** @var CollectionInterface $result */
        $result = $this->objectManager->create($this->className, [
            $this->data,
            self::$type
        ]);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->data = [];
    }
}
