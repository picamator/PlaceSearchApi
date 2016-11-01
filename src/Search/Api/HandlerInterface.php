<?php
namespace Picamator\PlaceSearchApi\Search\Api;

/**
 * Handler
 *
 * Implementation Chain of Responsibility
 * @see https://www.sitepoint.com/introduction-to-chain-of-responsibility/
 */
interface HandlerInterface
{
    /**
     * Sets successor, if current handler can not process query
     *
     * @param HandlerInterface $handler
     *
     * @return HandlerInterface
     */
    public function setSuccessor(HandlerInterface $handler) : self;

    /**
     * Handle, execute first handle that can manage query
     *
     * @param array $query
     *
     * @return mixed
     */
    public function handle(array $query);
}
