<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface;

/**
 * Value object for Response
 *
 * @codeCoverageIgnore
 */
class Response implements ResponseInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $container;

    /**
     * @param CollectionInterface   $data
     * @param int                   $code
     */
    public function __construct(CollectionInterface $data, int $code)
    {
        $this->container = [
            'data'  => $data,
            'count' => $data->count(),
            'code'  => $code
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
    public function getCode() : int
    {
        return $this->container['code'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->container;
    }

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return $this->container;
    }
}
