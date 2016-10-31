<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Handler;

use Picamator\PlaceSearchApi\Model\Api\PlaceRepositoryInterface;

/**
 * Engine handler
 */
class Engine extends AbstractHandler
{
    /**
     * @var PlaceRepositoryInterface
     */
    private $placeRepository;

    /**
     * @param PlaceRepositoryInterface $placeRepository
     */
    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function process(array $query)
    {
        return $this->placeRepository->search($query);
    }
}
