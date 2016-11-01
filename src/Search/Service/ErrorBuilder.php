<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search\Service;

use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Search\Api\Data\ErrorInterface;
use Picamator\PlaceSearchApi\Search\Api\Service\ErrorBuilderInterface;

/**
 * Builder for Error value object
 *
 * @codeCoverageIgnore
 */
class ErrorBuilder implements ErrorBuilderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var array
     */
    private static $defaultData = [
        'msg'   => 'Undefined Application Error',
        'code'  => 500
    ];

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @var array
     */
    private $data;


    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        string $className = 'Picamator\PlaceSearchApi\Search\Data\Error'
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage(string $message) : ErrorBuilderInterface
    {
        $this->data['msg'] = $message;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(int $code) : ErrorBuilderInterface
    {
        $this->data['code'] = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build() : ErrorInterface
    {
        if (empty($this->data['msg']) || empty($this->data['code'])) {
            $this->data = self::$defaultData;
        }

        /** @var LocationInterface $result */
        $result = $this->objectManager->create($this->className, [
            $this->data['msg'],
            $this->data['code']
        ]);
        $this->cleanData();

        return $result;
    }

    /**
     * Clean data
     */
    private function cleanData()
    {
        $this->data = [];
    }
}
