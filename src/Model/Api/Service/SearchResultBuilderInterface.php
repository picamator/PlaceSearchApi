<?php
namespace Picamator\PlaceSearchApi\Model\Api\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SearchResultInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Search Result data object
 */
interface SearchResultBuilderInterface
{
    /**
     * Sets data
     *
     * @param CollectionInterface $data
     *
     * @return SearchResultBuilderInterface
     */
    public function setData(CollectionInterface $data) : self;

    /**
     * Sets link
     *
     * @param CollectionInterface $link
     *
     * @return SearchResultBuilderInterface
     */
    public function setLink(CollectionInterface $link) : self;

    /**
     * Sets code
     *
     * @param int $code
     *
     * @return SearchResultBuilderInterface
     */
    public function setCode(int $code) : self;

    /**
     * Build
     *
     * @return SearchResultInterface
     *
     * @throws RuntimeException
     */
    public function build() : SearchResultInterface;
}
