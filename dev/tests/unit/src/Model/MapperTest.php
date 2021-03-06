<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Model;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Model\Mapper;

class MapperTest extends BaseTest
{
    /**
     * @var Mapper
     */
    private $mapper;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $schemaCollectionMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $barBuilderMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Service\LocationBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $locationBuilderMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->schemaCollectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->barBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface')
            ->getMock();

        $this->locationBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Service\LocationBuilderInterface')
            ->getMock();

        $this->mapper = new Mapper($this->objectManagerMock);
    }

    public function testMap()
    {
        $data = [
            'id'        => '2a293ddb8ddfdc1d65274d12c8465e50a3fe68ef',
            'place_id'  => 'ChIJkaVEf3Vz_UYRQdJXi93rMuo',
            'geometry' => [
                'location'  => [
                    'lat' => 10,
                    'lng' => 10
                ]
            ],
            'name' => 'Somewhere'
        ];

        // schema id mock
        $schemaIdMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $schemaIdMock->expects($this->once())
            ->method('getSource')
            ->willReturn('id');

        $schemaIdMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('id');

        $schemaIdMock->expects($this->once())
            ->method('getBuilder')
            ->willReturn('Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface');

        $schemaIdMock->expects($this->once())
            ->method('getSchemaCollection');

        // schema place id mock
        $schemaPlaceIdMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $schemaPlaceIdMock->expects($this->once())
            ->method('getSource')
            ->willReturn('place_id');

        $schemaPlaceIdMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('placeId');

        $schemaPlaceIdMock->expects($this->once())
            ->method('getBuilder')
            ->willReturn('Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface');

        $schemaPlaceIdMock->expects($this->once())
            ->method('getSchemaCollection');

        // schema location mock
        $schemaLocationMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $schemaLocationMock->expects($this->once())
            ->method('getSource')
            ->willReturn('geometry.location');

        $schemaLocationMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('location');

        $schemaLocationMock->expects($this->once())
            ->method('getBuilder')
            ->willReturn('Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface');

        // schema latitude mock
        $schemaLatitudeMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $schemaLatitudeMock->expects($this->once())
            ->method('getSource')
            ->willReturn('lat');

        $schemaLatitudeMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('latitude');

        $schemaLatitudeMock->expects($this->once())
            ->method('getBuilder')
            ->willReturn('Picamator\PlaceSearchApi\Model\Api\Service\LocationBuilderInterface');

        $schemaLatitudeMock->expects($this->once())
            ->method('getSchemaCollection');

        // schema longitude mock
        $schemaLongitudeMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $schemaLongitudeMock->expects($this->once())
            ->method('getSource')
            ->willReturn('lng');

        $schemaLongitudeMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('longitude');

        $schemaLongitudeMock->expects($this->once())
            ->method('getBuilder')
            ->willReturn('Picamator\PlaceSearchApi\Model\Api\Service\LocationBuilderInterface');

        $schemaLongitudeMock->expects($this->once())
            ->method('getSchemaCollection');

        //  schema location mock: latitude, longitude
        $schemaDataLocation = [
            $schemaLatitudeMock,
            $schemaLongitudeMock
        ];

        $schemaLocationCollectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $schemaLocationCollectionMock->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayIterator($schemaDataLocation));

        $schemaLocationMock->expects($this->once())
            ->method('getSchemaCollection')
            ->willReturn($schemaLocationCollectionMock);

        // schema name mock
        $schemaNameMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $schemaNameMock->expects($this->once())
            ->method('getSource')
            ->willReturn('name');

        $schemaNameMock->expects($this->once())
            ->method('getDestination')
            ->willReturn('name');

        $schemaNameMock->expects($this->once())
            ->method('getBuilder')
            ->willReturn('Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface');

        $schemaNameMock->expects($this->once())
            ->method('getSchemaCollection');

        // schema collection mock
        $schemaData = [
            $schemaIdMock,
            $schemaPlaceIdMock,
            $schemaLocationMock,
            $schemaNameMock
        ];

        $this->schemaCollectionMock->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayIterator($schemaData));

        // object manager mock
        $this->objectManagerMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturnCallback(function($argument) {
                return $argument === 'Picamator\PlaceSearchApi\Model\Api\Service\PlaceBuilderInterface'
                    ? $this->barBuilderMock
                    : $this->locationBuilderMock;

            });

        $this->mapper->map($this->schemaCollectionMock, $data);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RuntimeException
     */
    public function testFailedMap()
    {
        $data = [
            'id' => 1
        ];

        // schema collection mock
        $schemaData = [];
        $this->schemaCollectionMock->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayIterator($schemaData));

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->mapper->map($this->schemaCollectionMock, $data);
    }
}
