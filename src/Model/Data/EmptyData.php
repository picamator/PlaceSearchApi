<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\EmptyDataInterface;

/**
 * Value object for Empty data
 *
 * @codeCoverageIgnore
 */
class EmptyData implements EmptyDataInterface, \JsonSerializable
{
    /**
     * @var \stdClass
     */
    private $data;

    public function __construct()
    {
        $this->data = new \stdClass();
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function __debugInfo()
    {
        return $this->data;
    }
}
