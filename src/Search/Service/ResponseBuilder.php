<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface;
use Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface;
use Picamator\PlaceSearchApi\Search\Exception\RuntimeException;

/**
 * Builder for Response data objectManager
 */
class ResponseBuilder implements ResponseBuilderInterface
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @var CollectionInterface
     */
    private $data;

    /**
     * @var int
     */
    private $code;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'Picamator\PlaceSearchApi\Search\Data\Response'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setData(CollectionInterface $data) : ResponseBuilderInterface
    {
        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setCode(int $code) : ResponseBuilderInterface
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : ResponseInterface
    {
        if (is_null($this->data) || is_null($this->code)) {
            throw new RuntimeException('Required fields "data or link" was not set');
        }

        /** @var SearchResultInterface $result */
        $result = $this->objectManager->create($this->className, [
            $this->data,
            $this->code
        ]);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->data = null;
        $this->code = null;
    }
}
