<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Engine\GoogleSearchPlace\Http;

use Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Http\Crawler;
use Picamator\PlaceSearchApi\Model\Exception\InvalidArgumentException;
use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;

class CrawlerTest extends BaseTest
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Http\ClientInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $clientMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $responseMock;

    /**
     * @var \Psr\Http\Message\StreamInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $streamMock;

    protected function setUp()
    {
        parent::setUp();

        $this->clientMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Http\ClientInterface')
            ->getMock();

        $this->responseMock = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();

        $this->streamMock = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();

        $this->crawler = new Crawler($this->clientMock);
    }

    public function testGet()
    {
        $query  = [];
        $body   = [
            'status' => 'OK',
            'results' => []
        ];

        // client mock
        $this->clientMock->expects($this->once())
            ->method('get')
            ->willReturn($this->responseMock);

        // stream mock
        $this->streamMock->expects($this->once())
            ->method('seek');
        $this->streamMock->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($body));

        // response mock
        $this->responseMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->crawler->get($query);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\CrawlerException
     */
    public function testFailedHttpStatusGet()
    {
        $query  = [];

        // client mock
        $this->clientMock->expects($this->once())
            ->method('get')
            ->willReturn($this->responseMock);

        // response mock
        $this->responseMock->expects($this->exactly(2))
            ->method('getStatusCode')
            ->willReturn(500);

        // never
        $this->responseMock->expects($this->never())
            ->method('getBody');

        $this->crawler->get($query);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\CrawlerException
     */
    public function testFailedResultStatusGet()
    {
        $query  = [];
        $body   = [
            'status' => 'Invalid status',
            'results' => []
        ];

        // client mock
        $this->clientMock->expects($this->once())
            ->method('get')
            ->willReturn($this->responseMock);

        // stream mock
        $this->streamMock->expects($this->once())
            ->method('seek');
        $this->streamMock->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($body));

        // response mock
        $this->responseMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->crawler->get($query);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\CrawlerException
     */
    public function testFailedGet()
    {
        $query  = [];

        // client mock
        $this->clientMock->expects($this->once())
            ->method('get')
            ->willThrowException(new InvalidArgumentException());

        $this->crawler->get($query);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\CrawlerException
     */
    public function testFailedEncodeGet()
    {
        $query  = [];
        $body   = '{....';

        // client mock
        $this->clientMock->expects($this->once())
            ->method('get')
            ->willReturn($this->responseMock);

        // stream mock
        $this->streamMock->expects($this->once())
            ->method('seek');
        $this->streamMock->expects($this->once())
            ->method('getContents')
            ->willReturn($body);

        // response mock
        $this->responseMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->responseMock->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->crawler->get($query);
    }
}
