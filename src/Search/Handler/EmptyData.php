<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Handler;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\CollectionFactoryInterface;

/**
 * Empty handler as a default way to proceed query
 */
class EmptyData extends AbstractHandler
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $type = 'Picamator\PlaceSearchApi\Model\Api\Data\EmptyData';

    /**
     * @var CollectionFactoryInterface
     */
    private $collectionFactory;

    /**
     * @param CollectionFactoryInterface $collectionFactory
     */
    public function __construct(CollectionFactoryInterface $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * {@inheritdoc}
     *
     * @return CollectionInterface
     */
    protected function process(array $query)
    {
       return $this->collectionFactory->create(self::$type, []);
    }
}
