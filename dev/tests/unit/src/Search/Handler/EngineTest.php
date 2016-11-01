<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Handler;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use \Picamator\PlaceSearchApi\Search\Handler\Engine;

class EngineTest extends BaseTest
{
    /**
     * @var EmptyData
     */
    private $handler;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\PlaceRepositoryInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $placeRespositoryMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->placeRespositoryMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\PlaceRepositoryInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->handler = new Engine($this->placeRespositoryMock);
    }

    public function testHandle()
    {
        $query = [];

        // place repository mock
        $this->placeRespositoryMock->expects($this->once())
            ->method('search')
            ->with($this->equalTo($query))
            ->willReturn($this->collectionMock);

        $this->handler->handle($query);
    }
}
