<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\LinkInterface;

/**
 * Object value for Link
 *
 * @codeCoverageIgnore
 */
class Link implements LinkInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param string $type
     * @param string $uri
     */
    public function __construct(string $type, string $uri)
    {
        $this->data = ['type' => $type, 'uri' => $uri];
    }

    /**
     * {@inheritdoc}
     */
    public function getType() : string
    {
        return $this->data['type'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUri() : string
    {
        return $this->data['uri'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}
