<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\CollectionFactoryInterface;

/**
 * Create Collection
 *
 * @codeCoverageIgnore
 */
class CollectionFactory implements CollectionFactoryInterface
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
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
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
    public function create(string $type, array $data) : CollectionInterface
    {
        return $this->objectManager->create($this->className, [$type, $data]);
    }
}
