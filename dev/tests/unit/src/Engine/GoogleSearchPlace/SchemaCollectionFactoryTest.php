<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Engine\GoogleSearchPlace;

use Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\SchemaCollectionFactory;
use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;

class SchemaCollectionFactoryTest extends BaseTest
{
    /**
     * @var SchemaCollectionFactory
     */
    private $schemaCollectionFactory;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Service\SchemaCollectionBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionBuilderMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Service\SchemaBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $schemaBuilderMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $schemaMock;

    protected function setUp()
    {
        parent::setUp();

        $this->collectionBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Service\SchemaCollectionBuilderInterface')
            ->getMock();

        $this->schemaBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Service\SchemaBuilderInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->schemaMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SchemaInterface')
            ->getMock();

        $this->schemaCollectionFactory = new SchemaCollectionFactory($this->collectionBuilderMock, $this->schemaBuilderMock);
    }

    public function testCreate()
    {
        // schema builder mock
        $this->schemaBuilderMock->expects($this->once())
            ->method('setSchemaCollection')
            ->willReturnSelf();

        $this->schemaBuilderMock->expects($this->atLeastOnce())
            ->method('setSource')
            ->willReturnSelf();

        $this->schemaBuilderMock->expects($this->atLeastOnce())
            ->method('setDestination')
            ->willReturnSelf();

        $this->schemaBuilderMock->expects($this->atLeastOnce())
            ->method('build')
            ->willReturn($this->schemaMock);

        $this->schemaBuilderMock->expects($this->atLeastOnce())
            ->method('setBuilder')
            ->willReturnSelf();

        // collection builder mock
        $this->collectionBuilderMock->expects($this->atLeastOnce())
            ->method('addSchema')
            ->willReturnSelf();

        $this->collectionBuilderMock->expects($this->exactly(2))
            ->method('build')
            ->willReturn($this->collectionMock);

        $this->schemaCollectionFactory->create();
    }
}
