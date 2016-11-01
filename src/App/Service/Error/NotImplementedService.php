<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Service\Error;

use Picamator\PlaceSearchApi\App\Api\ServiceInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ErrorInterface;
use Picamator\PlaceSearchApi\Search\Api\Service\ErrorBuilderInterface;

/**
 * Not implemented
 */
class NotImplementedService implements ServiceInterface
{
    /**
     * @var ErrorBuilderInterface
     */
    private $errorBuilder;

    /**
     * @param ErrorBuilderInterface $errorBuilder
     */
    public function __construct(ErrorBuilderInterface $errorBuilder)
    {
        $this->errorBuilder = $errorBuilder;
    }

    /**
     * {@inheritdoc}
     *
     * @return ErrorInterface
     */
    public function execute(array $data = [], ...$arguments)
    {
        return $this->errorBuilder
            ->setCode(501)
            ->setMessage('501 Not Implemented')
            ->build();
    }
}
