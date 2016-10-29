<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Engine\GoogleSearchPlace\Bar;

use Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Bar\PlaceRepository;
use Picamator\PlaceSearchApi\Model\Exception\CrawlerException;
use Picamator\PlaceSearchApi\Model\Exception\RuntimeException;
use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;

class PlaceRepositoryTest extends BaseTest
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Http\CrawlerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $crawlerMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $schemaCollectionMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\MapperInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $mapperMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    protected function setUp()
    {
        parent::setUp();

        $this->crawlerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Http\CrawlerInterface')
            ->getMock();

        $this->schemaCollectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->mapperMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\MapperInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->placeRepository = new PlaceRepository($this->crawlerMock, $this->schemaCollectionMock, $this->mapperMock);
    }

    public function testSearch()
    {
        $query = [];
        $response = [];

        // crawler mock
        $this->crawlerMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo($query))
            ->willReturn($response);

        // mapper mock
        $this->mapperMock->expects($this->once())
            ->method('map')
            ->with($this->equalTo($this->schemaCollectionMock), $this->equalTo($response))
            ->willReturn($this->collectionMock);

        $this->placeRepository->search($query);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RepositoryException
     */
    public function testFailedCrawlerSearch()
    {
        $query = [];

        // crawler mock
        $this->crawlerMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo($query))
            ->willThrowException(new CrawlerException());

        // never
        $this->mapperMock->expects($this->never())
            ->method('map');

        $this->placeRepository->search($query);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RepositoryException
     */
    public function testFailedMapperSearch()
    {
        $query = [];
        $response = [];

        // crawler mock
        $this->crawlerMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo($query))
            ->willReturn($response);

        // mapper mock
        $this->mapperMock->expects($this->once())
            ->method('map')
            ->with($this->equalTo($this->schemaCollectionMock), $this->equalTo($response))
            ->willThrowException(new RuntimeException());

        $this->placeRepository->search($query);
    }
}
