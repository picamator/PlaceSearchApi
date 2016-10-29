<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Engine\GoogleSearchPlace\Http;

use Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Http\ClientFactory;
use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;

class ClientFactoryTest extends BaseTest
{
    /**
     * @var ClientFactory
     */
    private $clientFactory;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManagerMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\ConfigInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

    /**
     * @var \Picamator\PlaceSearchApi\Model\Api\Http\ClientInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    private $clientMock;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManagerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface')
            ->getMock();

        $this->configMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\ConfigInterface')
            ->getMock();

        $this->clientMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Model\Api\Http\ClientInterface')
            ->getMock();

        $this->clientFactory = new ClientFactory($this->objectManagerMock, $this->configMock);
    }

    public function testCreate()
    {
        $configSection = 'http_client_place';
        $config = [
            'endpoint'  => 'http://my-host.api.dev',
            'service'   => '/map',
            'operation' => 'search',
            'format'    => '\json/',
            'proxy'     => '127.0.0.1:8888'
        ];

        $options = [
            'proxy'     => $config['proxy'],
            'base_uri'  => 'http://my-host.api.dev/map/search/json'
        ];

        // config mock
        $this->configMock->expects($this->exactly(5))
            ->method('search')
            ->withConsecutive(
                [$this->equalTo($configSection), $this->equalTo('endpoint')],
                [$this->equalTo($configSection), $this->equalTo('service')],
                [$this->equalTo($configSection), $this->equalTo('operation')],
                [$this->equalTo($configSection), $this->equalTo('format')],
                [$this->equalTo($configSection), $this->equalTo('proxy')]
            )->willReturnCallback(function($section, $key) use ($config) {
                return $config[$key] ?? null;
            });

        // object manager mock
        $this->objectManagerMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo('Picamator\PlaceSearchApi\Model\Client'), $this->equalTo($options))
            ->willReturn($this->clientMock);

        $this->clientFactory->create();
    }
}
