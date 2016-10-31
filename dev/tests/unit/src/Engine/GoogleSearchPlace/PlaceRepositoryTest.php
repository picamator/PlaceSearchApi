<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Engine\GoogleSearchPlace;

use Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\PlaceRepository;
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
     * @var \Picamator\PlaceSearchApi\Search\Api\Http\CrawlerInterface | \PHPUnit_Framework_MockObject_MockObject
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
     * @var \Picamator\PlaceSearchApi\Model\Api\Service\PlaceCollectionBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $placeCollectionBuilderMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $collectionMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $placeMock;

    protected function setUp()
    {
        parent::setUp();

        $this->crawlerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Http\CrawlerInterface')
            ->getMock();

        $this->schemaCollectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->mapperMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\MapperInterface')
            ->getMock();

        $this->placeCollectionBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Service\PlaceCollectionBuilderInterface')
            ->getMock();

        $this->collectionMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\CollectionInterface')
            ->getMock();

        $this->placeMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Data\PlaceInterface')
            ->getMock();

        $this->placeRepository = new PlaceRepository(
            $this->crawlerMock,
            $this->schemaCollectionMock,
            $this->mapperMock,
            $this->placeCollectionBuilderMock
        );
    }

    public function testSearch()
    {
        $query = [];
        $response = [['id' => 1]];

        // crawler mock
        $this->crawlerMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo($query))
            ->willReturn($response);

        // mapper mock
        $this->mapperMock->expects($this->once())
            ->method('map')
            ->with($this->equalTo($this->schemaCollectionMock), $this->equalTo($response[0]))
            ->willReturn($this->placeMock);

        // place collection builder mock
        $this->placeCollectionBuilderMock->expects($this->once())
            ->method('addPlace')
            ->with($this->equalTo($this->placeMock))
            ->willReturnSelf();

        $this->placeCollectionBuilderMock->expects($this->once())
            ->method('build')
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
        $response = [['id' => 1]];

        // crawler mock
        $this->crawlerMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo($query))
            ->willReturn($response);

        // mapper mock
        $this->mapperMock->expects($this->once())
            ->method('map')
            ->with($this->equalTo($this->schemaCollectionMock), $this->equalTo($response[0]))
            ->willThrowException(new RuntimeException());

        $this->placeRepository->search($query);
    }
}
