<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\App\Controller;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\App\Controller\ErrorController;

class ErrorControllerTest extends BaseTest
{
    /**
     * @var ErrorController
     */
    private $controller;

    /**
     * @var \Symfony\Component\HttpFoundation\Request | \PHPUnit_Framework_MockObject_MockObject
     */
    private $requestMock;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder | \PHPUnit_Framework_MockObject_MockObject
     */
    private $containerBuilderMock;

    /**
     * @var \Silex\Application | \PHPUnit_Framework_MockObject_MockObject
     */
    private $applicationMock;

    protected function setUp()
    {
        parent::setUp();

        $this->requestMock = $this->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->getMock();

        // application mock
        $this->containerBuilderMock = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->getMock();

        $this->applicationMock = $this->getMockBuilder('Silex\Application')
            ->getMock();
        $this->applicationMock->method('offsetGet')
            ->willReturn($this->containerBuilderMock);

        $this->controller = new ErrorController();
    }

    public function testGetNotImplemented()
    {
        $serviceResult = [];

        // service mock
        $serviceMock = $this->getMockBuilder('Picamator\PlaceSearchApi\App\Service\Error\NotImplementedService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('execute')
            ->willReturn($serviceResult);

        // container builder mock
        $this->containerBuilderMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('app_error_not_implemented_service'))
            ->willReturn($serviceMock);

        // application mock
        $this->applicationMock->expects($this->once())
            ->method('json')
            ->with($this->equalTo($serviceResult), $this->equalTo(501));

        $this->controller->getNotImplemented($this->requestMock, $this->applicationMock);
    }

    public function testGetNotFound()
    {
        $serviceResult = [];

        // service mock
        $serviceMock = $this->getMockBuilder('Picamator\PlaceSearchApi\App\Service\Error\NotFoundService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('execute')
            ->willReturn($serviceResult);

        // container builder mock
        $this->containerBuilderMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('app_error_not_found_service'))
            ->willReturn($serviceMock);

        // application mock
        $this->applicationMock->expects($this->once())
            ->method('json')
            ->with($this->equalTo($serviceResult), $this->equalTo(404));

        $this->controller->getNotFound($this->requestMock, $this->applicationMock);
    }

    public function testGetInternalServer()
    {
        $serviceResult = [];

        // service mock
        $serviceMock = $this->getMockBuilder('Picamator\PlaceSearchApi\App\Service\Error\InternalServerService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('execute')
            ->willReturn($serviceResult);

        // container builder mock
        $this->containerBuilderMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo('app_internal_server_service'))
            ->willReturn($serviceMock);

        // application mock
        $this->applicationMock->expects($this->once())
            ->method('json')
            ->with($this->equalTo($serviceResult), $this->equalTo(500));

        $this->controller->getInternalServer($this->requestMock, $this->applicationMock);
    }
}
