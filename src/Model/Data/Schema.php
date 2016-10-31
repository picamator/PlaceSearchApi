<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface;

/**
 * Object value for Schema
 *
 * @codeCoverageIgnore
 */
class Schema implements SchemaInterface
{
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
     * @param string                    $source
     * @param string                    $destination
     * @param string                    $builder
     * @param CollectionInterface|null  $schemaCollection
     */
    public function __construct(
        string              $source,
        string              $destination,
        string              $builder,
        CollectionInterface $schemaCollection = null
    ) {
        $this->source           = $source;
        $this->destination      = $destination;
        $this->builder          = $builder;
        $this->schemaCollection = $schemaCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getSource() : string
    {
        return $this->source;
    }

    /**
     * {@inheritdoc}
     */
    public function getDestination() : string
    {
        return $this->destination;
    }

    /**
     * {@inheritdoc}
     */
    public function getBuilder() : string
    {
        return $this->builder;
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaCollection()
    {
       return $this->schemaCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return [
            'source'            => $this->source,
            'destination'       => $this->destination,
            'builder'           => $this->builder,
            'schemaCollection'  => $this->schemaCollection,

        ];
    }
}
