<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Model;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Model\Service\PlaceBuilder;

class PlaceBuilderTest extends BaseTest
{
    /**
     * @var PlaceBuilder
     */
    private $builder;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $locationMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $barMock;

    /** @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject */
    private $objectManagerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->locationMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface')
            ->getMock();

        $this->barMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface')
            ->getMock();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->builder = new PlaceBuilder($this->objectManagerMock);
    }

    public function testBuild()
    {
        $data = [
            'id'        => 1,
            'placeId'   => null,
            'location'  => $this->locationMock,
            'name'      => 'test',
            'icon'      => null,
            'vicinity'  => null,
            'scope'     => null
        ];

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Model\Data\Place'), $this->equalTo(array_values($data)))
            ->willReturn($this->barMock);

        $this->builder->setId($data['id'])
            ->setLocation($data['location'])
            ->setName($data['name'])
            ->build();
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RuntimeException
     */
    public function testFailedBuild()
    {
        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->builder->build();
    }
}
