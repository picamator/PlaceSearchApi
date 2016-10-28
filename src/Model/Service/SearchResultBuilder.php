<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Service;

use Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface;
use Picamator\PlaceSearchApi\Model\Api\Data\SearchResultInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Model\Api\Service\SearchResultBuilderInterface;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;

/**
 * Builder for Search Result data object
 */
class SearchResultBuilder implements SearchResultBuilderInterface
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
     * @var CollectionInterface
     */
    private $link;

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
        string $className = 'Picamator\PlaceSearchApi\Model\Data\SearchResult'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setData(CollectionInterface $data) : SearchResultBuilderInterface
    {
        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setLink(CollectionInterface $link) : SearchResultBuilderInterface
    {
        $this->link = $link;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function setCode(int $code) : SearchResultBuilderInterface
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : SearchResultInterface
    {
        if (is_null($this->data) || is_null($this->code) || is_null($this->link)) {
            throw new RuntimeException('Required fields "data, code or link" was not set');
        }

        /** @var SearchResultInterface $result */
        $result = $this->objectManager->create($this->className, [
            $this->data,
            $this->code,
            $this->link
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
        $this->link = null;
        $this->code = null;
    }
}
