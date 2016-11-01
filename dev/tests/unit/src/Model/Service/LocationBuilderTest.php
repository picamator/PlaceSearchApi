<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Model;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Model\Service\LocationBuilder;

class LocationBuilderTest extends BaseTest
{
    /**
     * @var LocationBuilder
     */
    private $builder;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $locationMock;

    /** @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject */
    private $objectManagerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->locationMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\LocationInterface')
            ->getMock();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->builder = new LocationBuilder($this->objectManagerMock);
    }

    public function testBuild()
    {
        $data = [
            'lat' => 10,
            'lng' => 10
        ];

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Model\Data\Location'), $this->equalTo(array_values($data)))
            ->willReturn($this->locationMock);

        $this->builder->setLatitude($data['lat'])
            ->setLongitude($data['lng'])
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

    /**
     * @dataProvider providerFailedSetLatitude
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException
     *
     * @param float $latitude
     */
    public function testFailedSetLatitude($latitude)
    {
        $this->builder->setLatitude($latitude);
    }

    /**
     * @dataProvider providerFailedSetLongitude
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException
     *
     * @param float $longitude
     */
    public function testFailedSetLongitude($longitude)
    {
        $this->builder->setLongitude($longitude);
    }

    public function providerFailedSetLongitude()
    {
        return [
            [180.000001],
            [-180.00001],
            [180.0001],
            [-180.0001],
            [181.0],
            [-181.0]
        ];
    }

    public function providerFailedSetLatitude()
    {
        return [
            [90.000001],
            [-90.00001],
            [90.0001],
            [-90.0001],
            [91.0],
            [-91.0]
        ];
    }
}
