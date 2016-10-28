<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Model\Data;

use Picamator\PlaceSearchApi\Model\Api\Data\ErrorInterface;

/**
 * Value object for Error
 *
 * @codeCoverageIgnore
 */
class Error implements ErrorInterface, \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param string    $message
     * @param int       $code
     */
    public function __construct(string $message, int $code)
    {
        $this->data = ['msg' => $message, 'code' => $code];
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage() : string
    {
        return $this->data['msg'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCode() : int
    {
        return $this->data['code'];
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return $this->data;
    }
}
