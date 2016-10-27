<?php
namespace Picamator\PlaceSearchApi\Model\Api\Data;

/**
 * Object value for Link
 */
interface LinkInterface 
{
    /**
     * Retrieve type
     * 
     * @return string e.g. self
     */
    public function getType() : string;
    
    /**
     * Retrieve uri
     * 
     * @return string
     */
    public function getUri() : string;
}
