<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SearchResultInterface;

/**
 * Value object for search result
 *
 * @codeCoverageIgnore
 */
class SearchResult implements SearchResultInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $container;

    /**
     * @param CollectionInterface   $data
     * @param CollectionInterface   $link
     * @param int                   $code
     */
    public function __construct(CollectionInterface $data, CollectionInterface $link, int $code)
    {
        $this->container = [
            'data'  => $data,
            'count' => $data->count(),
            'link' => $link,
            'code' => $code
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getData() : CollectionInterface
    {
       return $this->container['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCount() : int
    {
        return $this->container['count'];
    }

    /**
     * {@inheritdoc}
     */
    public function getLink() : CollectionInterface
    {
        return $this->container['link'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCode() : int
    {
        return $this->container['code'];
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return $this->container;
    }
}
