<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\App\Service\Place;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\App\Service\Place\GetService;

class GetServiceTest extends BaseTest
{
    /**
     * @var GetService
     */
    private $service;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $handlerFirstMock;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $handlerSecondMock;
    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $handlerThirdMock;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseBuilderMock;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->handlerFirstMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\HandlerInterface')
            ->getMock();

        $this->handlerSecondMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\HandlerInterface')
            ->getMock();

        $this->handlerThirdMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\HandlerInterface')
            ->getMock();

        $this->responseBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Service\ResponseBuilderInterface')
            ->getMock();

        $this->responseMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->service = new GetService(
            $this->handlerFirstMock,
            $this->handlerSecondMock,
            $this->handlerThirdMock,
            $this->responseBuilderMock
        );
    }

    public function testExecute()
    {
        $data = [];

        // handler mock
        $this->handlerFirstMock->expects($this->once())
            ->method('handle')
            ->with($this->equalTo($data))
            ->willReturn($this->collectionMock);

        $this->handlerFirstMock->expects($this->exactly(2))
            ->method('setSuccessor')
            ->willReturnSelf();

        // response builder mock
        $this->responseBuilderMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->collectionMock))
            ->willReturnSelf();

        $this->responseBuilderMock->expects($this->once())
            ->method('setCode')
            ->with($this->equalTo(200))
            ->willReturnSelf();

        $this->responseBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($this->responseMock);

        $this->service->execute($data);
    }
}
