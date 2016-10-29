<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\SchemaCollectionBuilderInterface;

/**
 * Builder fo Schema collection
 *
 * @codeCoverageIgnore
 */
class SchemaCollectionBuilder implements SchemaCollectionBuilderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $type = 'Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface';

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
    public function addSchema(SchemaInterface $schema) : SchemaCollectionBuilderInterface
    {
        $this->data[] = $schema;

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
