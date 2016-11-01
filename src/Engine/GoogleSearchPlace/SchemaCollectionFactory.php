<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace;

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
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder'
        ], [
            'source'        => 'place_id',
            'destination'   => 'placeId',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder'
        ], [
            'source'        => 'geometry.location',
            'destination'   => 'location',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder',
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
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder'
        ], [
            'source'        => 'icon',
            'destination'   => 'icon',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder'
        ], [
            'source'        => 'vicinity',
            'destination'   => 'vicinity',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder'
        ], [
            'source'        => 'scope',
            'destination'   => 'scope',
            'builder'       => 'Picamator\PlaceSearchApi\Model\Service\PlaceBuilder'
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
        $schemList = $this->getSchemaList(self::$schema);

        return $this->buildCollection($schemList);
    }

    /**
     * Retrieve schema list
     *
     * @param array $schema
     *
     * @return array
     */
    private function getSchemaList(array $schema) : array
    {
        $result = [];
        foreach ($schema as $item) {
            if (!empty($item['schema'])) {
                $subSchema             = $this->getSchemaList($item['schema']);
                $subSchemaCollection   = $this->buildCollection($subSchema);

                $this->schemaBuilder->setSchemaCollection($subSchemaCollection);
            }

            $this->schemaBuilder
                ->setSource($item['source'])
                ->setDestination($item['destination'])
                ->setBuilder($item['builder']);

            $result[] = $this->schemaBuilder->build();

        }

        return $result;
    }

    /**
     * Build collection
     *
     * @param array $data
     *
     * @return CollectionInterface
     */
    private function buildCollection(array $data) : CollectionInterface
    {
        foreach($data as $item) {
            $this->collectionBuilder->addSchema($item);
        }

        return $this->collectionBuilder->build();
    }
}
