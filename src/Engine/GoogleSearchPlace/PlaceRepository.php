<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\PlaceCollectionBuilderInterface;
use Picamator\PlaceSearchApi\Search\Api\Http\CrawlerInterface;
use Picamator\PlaceSearchApi\Model\Api\MapperInterface;
use Picamator\PlaceSearchApi\Model\Api\PlaceRepositoryInterface;
use Picamator\PlaceSearchApi\Model\Exception\CrawlerException;
use Picamator\PlaceSearchApi\Model\Exception\RepositoryException;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Repository for searching places
 */
class PlaceRepository implements PlaceRepositoryInterface
{
    /**
     * @var CrawlerInterface
     */
    private $crawler;

    /**
     * @var CollectionInterface
     */
    private $schema;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @var PlaceCollectionBuilderInterface
     */
    private $placeCollectionBuilder;

    /**
     * @param CrawlerInterface                  $crawler
     * @param CollectionInterface               $schema
     * @param MapperInterface                   $mapper
     * @param PlaceCollectionBuilderInterface   $placeCollectionBuilder
     */
    public function __construct(
        CrawlerInterface                    $crawler,
        CollectionInterface                 $schema,
        MapperInterface                     $mapper,
        PlaceCollectionBuilderInterface     $placeCollectionBuilder
    ) {
        $this->crawler                  = $crawler;
        $this->schema                   = $schema;
        $this->mapper                   = $mapper;
        $this->placeCollectionBuilder   = $placeCollectionBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function search(array $query) : CollectionInterface
    {
        try {
            $data = $this->crawler->get($query);
            foreach ($data as $item) {
                $placeItem = $this->mapper->map($this->schema, $item);
                $this->placeCollectionBuilder->addPlace($placeItem);
            }

            $result = $this->placeCollectionBuilder->build();
        } catch (CrawlerException $e) {
            throw new RepositoryException('Crawler was failed to make request', 0, $e);
        } catch (RuntimeException $e) {
            throw new RepositoryException('Mapping process was failed', 0, $e);
        }

        return $result;
    }
}
