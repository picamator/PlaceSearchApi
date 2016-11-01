<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Handler;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use \Picamator\PlaceSearchApi\Search\Handler\EmptyData;

class EmptyDataTest extends BaseTest
{
    /**
     * @var EmptyData
     */
    private $handler;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Service\CollectionFactoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionFactoryMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->collectionFactoryMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Service\CollectionFactoryInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->handler = new EmptyData($this->collectionFactoryMock);
    }

    public function testHandle()
    {
        $query = [];

        // collection factory mock
        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Model\Api\Data\EmptyData'),  $this->equalTo([]))
            ->willReturn($this->collectionMock);

        $this->handler->handle($query);
    }
}
