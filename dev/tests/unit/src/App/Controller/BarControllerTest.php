<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\App\Controller;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\App\Controller\BarController;

class BarControllerTest extends BaseTest
{
    /**
     * @var BarController
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

    /**
     * @var \Picamator\PlaceSearchApi\App\Service\Place\GetService | \PHPUnit_Framework_MockObject_MockObject
     */
    private $serviceMock;

    /**
     * @var \Picamator\PlaceSearchApi\Search\Api\ConfigInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

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

        $this->serviceMock = $this->getMockBuilder('Picamator\PlaceSearchApi\App\Service\Place\GetService')
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\ConfigInterface')
            ->getMock();

        $this->controller = new BarController();
    }

    public function testGetBar()
    {
        $serviceResult = [];

        // container builder mock
        $this->containerBuilderMock->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(
                ['app_place_get_service'],
                ['search_config']
            )->willReturnCallback(function($argument) {
                return $argument === 'app_place_get_service' ? $this->serviceMock : $this->configMock;
            });

        // config mock
        $this->configMock->expects($this->atLeastOnce())
            ->method('search');

        // request mock
        $this->requestMock->expects($this->atLeastOnce())
            ->method('get');

        // service mock
        $this->serviceMock->expects($this->once())
            ->method('execute')
            ->willReturn($serviceResult);

        // application mock
        $this->applicationMock->expects($this->once())
            ->method('json')
            ->with($this->equalTo($serviceResult), $this->equalTo(200));

        $this->controller->getBar($this->requestMock, $this->applicationMock);
    }
}
