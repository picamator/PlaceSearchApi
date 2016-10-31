<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Model;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Model\Service\SchemaBuilder;

class SchemaBuilderTest extends BaseTest
{
    /**
     * @var SchemaBuilder
     */
    private $builder;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $schemaMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->schemaMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $this->builder = new SchemaBuilder($this->objectManagerMock);
    }

    public function testBuild()
    {
        $source         = 'id';
        $destination    = 'id';
        $builder        = 'test';

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Model\Data\Schema'), $this->equalTo([
                $source,
                $destination,
                $builder,
                null
            ]))->willReturn($this->schemaMock);

        $this->builder
            ->setSource($source)
            ->setDestination($destination)
            ->setBuilder($builder)
            ->build();
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RuntimeException
     */
    public function testFailedNodBuilderBuild()
    {
        $source       = 'id';
        $destination  = 'id';

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->builder
            ->setSource($source)
            ->setDestination($destination)
            ->build();
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RuntimeException
     */
    public function testFailedNodDestinationBuild()
    {
        $source   = 'id';
        $builder  = 'id';

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->builder
            ->setSource($source)
            ->setBuilder($builder)
            ->build();
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RuntimeException
     */
    public function testFailedNodSourceBuild()
    {
        $destination    = 'id';
        $builder        = 'id';

        // never
        $this->objectManagerMock->expects($this->never())
            ->method('create');

        $this->builder
            ->setDestination($destination)
            ->setBuilder($builder)
            ->build();
    }
}
