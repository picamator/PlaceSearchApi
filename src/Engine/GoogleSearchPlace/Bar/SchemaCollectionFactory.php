<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Bar;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\SchemaBuilderInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\SchemaCollectionBuilderInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\SchemaCollectionFactoryInterface;

/**
 * Create Schema collection
 *
 * @todo move schema to configuration
 * @todo create abstraction for building collection
 */
class SchemaCollectionFactory implements SchemaCollectionFactoryInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var array
     */
    static private $schema = [
        [
            'source'        => 'id',
            'destination'   => 'id',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder'
        ], [
            'source'        => 'place_id',
            'destination'   => 'placeId',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder'
        ], [
            'source'        => 'location',
            'destination'   => 'location',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder',
            'schema'        => [
                [
                    'source'        => 'lat',
                    'destination'   => 'latitude',
                    'builder'       => 'Picamator\PlaceSearchApi\Model\Service\LocationBuilder'
                ],[
                    'source'        => 'lng',
                    'destination'   => 'longitude',
                    'builder'       => 'Picamator\PlaceSearchApi\Model\Service\LocationBuilder'
                ],
            ]
        ], [
            'source'        => 'name',
            'destination'   => 'name',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder'
        ], [
            'source'        => 'icon',
            'destination'   => 'icon',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder'
        ], [
            'source'        => 'vicinity',
            'destination'   => 'vicinity',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder'
        ], [
            'source'        => 'scope',
            'destination'   => 'scope',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\BarBuilder'
        ]
    ];

    /**
     * @var SchemaCollectionBuilderInterface
     */
    private $collectionBuilder;

    /**
     * @var SchemaBuilderInterface
     */
    private $schemaBuilder;

    /**
     * @param SchemaCollectionBuilderInterface $collectionBuilder
     * @param SchemaBuilderInterface $schemaBuilder
     */
    public function __construct(
        SchemaCollectionBuilderInterface    $collectionBuilder,
        SchemaBuilderInterface              $schemaBuilder
    ) {
        $this->collectionBuilder    = $collectionBuilder;
        $this->schemaBuilder        = $schemaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function create() : CollectionInterface
    {
        return $this->createCollection(self::$schema);
    }

    /**
     * Collection builder
     *
     * @param array $schema
     *
     * @return mixed
     */
    private function createCollection(array $schema) : CollectionInterface
    {
        foreach ($schema as $item) {
            if (!empty($item['schema'])) {
                $subSchemaCollection = $this->createCollection($item['schema']);
                $this->schemaBuilder->setSchemaCollection($subSchemaCollection);
            }

            $this->schemaBuilder
                ->setSource($item['source'])
                ->setDestination($item['destination'])
                ->setBuilder($item['builder']);

            $schemaInstance = $this->schemaBuilder->build();
            $this->collectionBuilder->addSchema($schemaInstance);
        }

        // attention: build clear all previously set data
        return $this->collectionBuilder->build();
    }
}
