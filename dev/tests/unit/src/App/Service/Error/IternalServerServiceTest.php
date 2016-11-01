<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\App\Service\Error;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\App\Service\Error\InternalServerService;

class IternalServerServiceTest extends BaseTest
{
    /**
     * @var InternalServerService
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

        $this->service = new InternalServerService($this->errorBuilderMock);
    }

    public function testExecute()
    {
        // error builder mock
        $this->errorBuilderMock->expects($this->once())
            ->method('setCode')
            ->with($this->equalTo(500))
            ->willReturnSelf();

        $this->errorBuilderMock->expects($this->once())
            ->method('setMessage')
            ->with($this->equalTo('500 Internal Server Error'))
            ->willReturnSelf();

        $this->errorBuilderMock->expects($this->once())
            ->method('build')
            ->willReturn($this->errorMock);

        $this->service->execute();
    }
}
