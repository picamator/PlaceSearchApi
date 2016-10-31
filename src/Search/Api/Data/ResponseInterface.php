<?php
namespace Picamator\PlaceSearchApi\Search\Api\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;

/**
 * Value object for Response
 */
interface ResponseInterface
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
     * Retrieve code
     * 
     * @return integer HTTP code
     */
    public function getCode() : int;
}
