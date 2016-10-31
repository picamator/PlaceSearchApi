<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ErrorCollectionBuilderInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ErrorInterface;

/**
 * Builder for Error collection
 *
 * @codeCoverageIgnore
 */
class ErrorCollectionBuilder implements ErrorCollectionBuilderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $type = 'Picamator\PlaceSearchApi\Search\Api\Data\ErrorInterface';

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
    public function addError(ErrorInterface $error) : ErrorCollectionBuilderInterface
    {
        $this->data[] = $error;

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
