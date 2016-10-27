<?php
namespace Picamator\PlaceSearchApi\Model\Api\Data;

use Picamator\PlaceSearchApi\Model\Data\CollectionInterface;

/**
 * Value object for search result
 */
interface SearchResultInterface
{
    /**
     * Retrieve data collection
     * 
     * @return CollectionInterface
     */
    public function getData() : CollectionInterface;
    
    /**
     * Retrieve count
     * 
     * @return integer
     */
    public function getCount() : int;
    
    /**
     * Retrieve link collection
     * 
     * @return CollectionInterface
     */
    public function getLink() : CollectionInterface;
    
    /**
     * Retrieve code
     * 
     * @return integer HTTP code
     */
    public function getCode() : int;
}
