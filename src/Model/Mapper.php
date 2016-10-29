<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface;
use Picamator\PlaceSearchApi\Model\Api\MapperInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

class Mapper implements MapperInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Builder container
     *
     * @var array
     */
    private $builderContainer = [];

    /**
     * @param ObjectManagerInterface    $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritdoc}
     */
    public function map(CollectionInterface $schema, array $data)
    {
        /** @var SchemaInterface $item */
        foreach ($schema as $item) {
            $source         = $item->getSource();
            $destination    = $this->getMethodName($item->getDestination());
            $builder        = $this->getBuilder($item->getBuilder());
            $dataItem       = $data[$source] ?? null;

            // run nested schema
            $schemaCollection = $item->getSchemaCollection();
            if (!is_null($schemaCollection) && is_array($dataItem)) {
                $dataItem = $this->map($schemaCollection, $dataItem);
            }

            call_user_func([$builder, $destination], $dataItem);
        }

        // validate build, just in case
        if (!isset($builder) || !method_exists($builder, 'build')) {
            throw new RuntimeException(
                sprintf('Builder "%s" does not have "build" method', get_class($builder))
            );
        }

        return $builder->build();
    }

    /**
     * Retrieve method name
     *
     * @param string $name
     *
     *
     * @return string
     */
    private function getMethodName(string $name) : string
    {
        return 'set' . ucfirst($name);
    }

    /**
     * Retrieve builder
     *
     * @param string $className
     *
     * @return mixed
     */
    private function getBuilder(string $className)
    {
        if (empty($this->builderContainer[$className])) {
            $this->builderContainer[$className] = $this->objectManager->create($className);
        }

        return $this->builderContainer[$className];
    }
}
