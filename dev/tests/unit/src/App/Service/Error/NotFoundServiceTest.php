<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\App\Service\Error;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\App\Service\Error\NotFoundService;

class NotFoundServiceTest extends BaseTest
{
    /**
     * @var NotFoundService
     */
    private $service;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Service\ErrorBuilderInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $errorBuilderMock;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\Data\ErrorInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $errorMock;

    protected function setUp()
    {
        parent::setUp();

        $this->errorBuilderMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Service\ErrorBuilderInterface')
            ->getMock();

        $this->errorMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\Data\ErrorInterface')
            ->getMock();

        $this->service = new NotFoundService($this->errorBuilderMock);
    }

    public function testExecute()
    {
        // error builder mock
        $this->errorBuilderMock->expects($this->once())
            ->method('setCode')
            ->with($this->equalTo(404))
            ->willReturnSelf();

        $this->errorBuilderMock->expects($this->once())
            ->method('setMessage')
            ->with($this->equalTo('404 Not Found'))
            ->willReturnSelf();

        $this->errorBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($this->errorMock);

        $this->service->execute();
    }
}
