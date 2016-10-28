<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\LinkInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\LinkCollectionBuilderInterface;

/**
 * Builder for Link collection
 *
 * @codeCoverageIgnore
 */
class LinkCollectionBuilder implements LinkCollectionBuilderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $type = 'Picamator\PlaceSearchApi\Model\Api\Data\LinkInterface';

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
    public function addLink(LinkInterface $link) : LinkCollectionBuilderInterface
    {
        $this->data[] = $link;

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
