<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Search;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Search\Service\ResponseBuilder;

class ResponseBuilderTest extends BaseTest
{
    /**
     * @var ResponseBuilder
     */
    private $builder;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseMock;

    /** @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject */
    private $objectManagerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->responseMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Data\ResponseInterface')
            ->getMock();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->builder = new ResponseBuilder($this->objectManagerMock);
    }

    public function testBuild()
    {
        $data = [
            'data' => $this->collectionMock,
            'code' => 200
        ];

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Search\Data\Response'), $this->equalTo(array_values($data)))
            ->willReturn($this->responseMock);

        $this->builder->setData($data['data'])
            ->setCode($data['code'])
            ->build();
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Search\Exception\RuntimeException
     */
    public function testFailedBuild()
    {
        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->builder->build();
    }
}
