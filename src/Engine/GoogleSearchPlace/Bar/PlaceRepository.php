<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Bar;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Http\CrawlerInterface;
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
    private $schemaCollection;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @param CrawlerInterface      $crawler
     * @param CollectionInterface   $schemaCollection
     * @param MapperInterface       $mapper
     */
    public function __construct(
        CrawlerInterface        $crawler,
        CollectionInterface     $schemaCollection,
        MapperInterface         $mapper
    ) {
        $this->crawler          = $crawler;
        $this->schemaCollection = $schemaCollection;
        $this->mapper           = $mapper;
    }

    /**
     * {@inheritdoc}
     */
    public function search(array $query) : CollectionInterface
    {
        try {
            $data   = $this->crawler->get($query);
            $result = $this->mapper->map($this->schemaCollection, $data);
        } catch (CrawlerException $e) {
            throw new RepositoryException('Crawler was failed to make request', 0, $e);
        } catch (RuntimeException $e) {
            throw new RepositoryException('Mapping process was failed', 0, $e);
        }

        return $result;
    }
}
