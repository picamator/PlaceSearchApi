<?php
namespace Picamator\PlaceSearchApi\Model\Api\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface;

/**
 * Value object for Bar
 */
interface BarInterface 
{
    /**
     * Retrieve identifier
     * 
     * @return string
     */
    public function getId() : string;
    
    /**
     * Retrieve place identifier
     * 
     * @return string
     */
    public function getPlaceId() : string;
    
    /**
     * Retrieve location
     * 
     * @return LocationInterface
     */
    public function getLocation() : LocationInterface;
    
    /**
     * Retrieve name
     * 
     * @return string
     */
    public function getName() : string;
    
    /**
     * Retrieve icon
     * 
     * @return string
     */
    public function getIcon() : string;
    
    /**
     * Retrieve vicinity
     * 
     * @return string
     */
    public function getVicinity() : string;
    
    /**
     * Retrieve scope
     * 
     * @return string
     */
    public function getScope() : string;
}
