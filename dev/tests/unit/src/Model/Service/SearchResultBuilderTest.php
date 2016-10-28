<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Model;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Model\Service\SearchResultBuilder;

class SearchResultBuilderTest extends BaseTest
{
    /**
     * @var SearchResultBuilder
     */
    private $builder;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\SearchResultInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $searchResultMock;

    /** @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject */
    private $objectManagerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->searchResultMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\SearchResultInterface')
            ->getMock();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->builder = new SearchResultBuilder($this->objectManagerMock);
    }

    public function testBuild()
    {
        $data = [
            'data' => $this->collectionMock,
            'code' => 200,
            'link' => $this->collectionMock
        ];

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Model\Data\SearchResult'), $this->equalTo(array_values($data)))
            ->willReturn($this->searchResultMock);

        $this->builder->setData($data['data'])
            ->setCode($data['code'])
            ->setlink($data['link'])
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
