<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\SchemaBuilderInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Build Schema value object
 */
class SchemaBuilder implements SchemaBuilderInterface
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
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var string
     */
    private $builder;

    /**
     * @var null | CollectionInterface
     */
    private $schemaCollection;

    /**
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'Picamator\PlaceSearchApi\Model\Data\Schema'
    ) {
        $this->objectManager    = $objectManager;
        $this->className        = $className;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setSource(string $source) : SchemaBuilderInterface
    {
        $this->source = $source;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setDestination(string $destination) : SchemaBuilderInterface
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setBuilder(string $builder) : SchemaBuilderInterface
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setSchemaCollection(CollectionInterface $schemaCollection) : SchemaBuilderInterface
    {
        $this->schemaCollection = $schemaCollection;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : SchemaInterface
    {
        if (is_null($this->source)
            || is_null($this->destination)
            || is_null($this->builder)
        ) {
            throw new RuntimeException('Required fields "source, destination or builder" was not set');
        }

        /** @var SchemaInterface $result */
        $result = $this->objectManager->create($this->className, [
            $this->source,
            $this->destination,
            $this->builder,
            $this->schemaCollection
        ]);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->source           = null;
        $this->destination      = null;
        $this->builder          = null;
        $this->schemaCollection = null;
    }
}
