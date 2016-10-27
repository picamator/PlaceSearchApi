<?php
namespace Picamator\PlaceSearchApi\Model\Api\Data;

/**
 * Value object for Location
 */
interface LocationInterface 
{
    /**
     * Retrieve latitude
     * 
     * @return float [-90, 90]
     */
    public function getLatitude() : float;
    
    /**
     * Retrieve longitude
     * 
     * @return float [-180, 180]
     */
    public function getLongitude() : float;
}
