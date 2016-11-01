<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Service\Place;

use Picamator\PlaceSearchApi\App\Api\ServiceInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface;
use Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface;
use Picamator\PlaceSearchApi\Search\Api\HandlerInterface;

/**
 * Service for GET:/bar
 */
class GetService implements ServiceInterface
{
    /**
     * @var HandlerInterface
     */
    private $engineHandler;

    /**
     * @var HandlerInterface
     */
    private $cacheHandler;

    /**
     * @var HandlerInterface
     */
    private $emptyHandler;

    /**
     * @var ResponseBuilderInterface
     */
    private $responseBuilder;

    /**
     * @param HandlerInterface          $engineHandler
     * @param HandlerInterface          $cacheHandler
     * @param HandlerInterface          $emptyHandler
     * @param ResponseBuilderInterface  $responseBuilder
     */
    public function __construct(
       HandlerInterface         $engineHandler,
       HandlerInterface         $cacheHandler,
       HandlerInterface         $emptyHandler,
       ResponseBuilderInterface $responseBuilder
    ) {
        $this->engineHandler    = $engineHandler;
        $this->cacheHandler     = $cacheHandler;
        $this->emptyHandler     = $emptyHandler;
        $this->responseBuilder  = $responseBuilder;
    }

    /**
     * {@inheritdoc}
     *
     * @return ResponseInterface
     */
    public function execute(array $data = [], ...$arguments)
    {
        $this->engineHandler
            ->setSuccessor($this->cacheHandler)
            ->setSuccessor($this->emptyHandler);

        $engineData = $this->engineHandler->handle($data);
        $response   = $this->responseBuilder
            ->setData($engineData)
            ->setCode(200)
            ->build();

        return $response;
    }
}
