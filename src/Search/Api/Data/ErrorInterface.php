<?php
namespace Picamator\PlaceSearchApi\Search\Api\Data;

/**
 * Value object for Error
 */
interface ErrorInterface
{
    /**
     * Retrieve message
     *
     * @return string
     */
    public function getMessage() : string;

    /**
     * Retrieve code
     *
     * @return int
     */
    public function getCode() : int;
}
