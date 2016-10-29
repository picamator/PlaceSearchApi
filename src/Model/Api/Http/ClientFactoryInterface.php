<?php
namespace Picamator\PlaceSearchApi\Model\Api\Http;

/**
 * Create client
 */
interface ClientFactoryInterface
{
    /**
     * Create
     *
     * @return ClientInterface
     */
    public function create() : ClientInterface;
}
