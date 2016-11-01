<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Handler;

use Picamator\PlaceSearchApi\Search\Api\HandlerInterface;

/**
 * Handler
 *
 * Implementation Chain of Responsibility
 * @see https://www.sitepoint.com/introduction-to-chain-of-responsibility/
 */
abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var HandlerInterface
     */
    private $successor;

    /**
     * {@inheritdoc}
     */
    final public function setSuccessor(HandlerInterface $handler) : HandlerInterface
    {
        if (is_null($this->successor)) {
            $this->successor = $handler;
            return $this;
        }
        $this->successor->setSuccessor($handler);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    final public function handle(array $query)
    {
        $result = $this->process($query);

        if (is_null($result) && !is_null($this->successor)) {
            $result = $this->successor->handle($query);
        }

        return $result;
    }

    /**
     * Process
     *
     * @param array $query
     *
     * @return mixed | null null for dispatching query to next successor
     */
    abstract protected function process(array $query);
}
