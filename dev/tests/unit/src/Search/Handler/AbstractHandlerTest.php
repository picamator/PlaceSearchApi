<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Handler;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;

class AbstractHandlerTest extends BaseTest
{
    /**
     * @var \Picamator\PlaceSearchApi\Search\Handler\AbstractHandler | \PHPUnit_Framework_MockObject_MockObject
     */
    private $handlerMock;

    protected function setUp()
    {
        parent::setUp();

        $this->handlerMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Handler\AbstractHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();
    }

    public function testSetSuccessor()
    {
        // successor mock
        $successorFirstMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\HandlerInterface')
            ->getMock();

        $successorSecondMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Api\HandlerInterface')
            ->getMock();

        $successorFirstMock->expects($this->once())
            ->method('setSuccessor')
            ->with($this->equalTo($successorSecondMock))
            ->willReturnSelf();

        $this->handlerMock
            ->setSuccessor($successorFirstMock)
            ->setSuccessor($successorSecondMock);
    }

    public function testHandle()
    {
        $query          = [];
        $resultFirst    = null;
        $resultSecond   = ['Second'];

        // successor mock
        $successorFirstMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Handler\AbstractHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();

        $successorFirstMock->expects($this->once())
            ->method('process')
            ->willReturn($resultFirst);

        $successorSecondMock = $this->getMockBuilder('Picamator\PlaceSearchApi\Search\Handler\AbstractHandler')
            ->setMethods(['process'])
            ->getMockForAbstractClass();

        $successorSecondMock->expects($this->once())
            ->method('process')
            ->willReturn($resultSecond);

        // handler mock
        $this->handlerMock->expects($this->once())
            ->method('process')
            ->willReturn(null);

        $this->handlerMock
            ->setSuccessor($successorFirstMock)
            ->setSuccessor($successorSecondMock);

        $actual = $this->handlerMock->handle($query);
        $this->assertEquals($actual, $resultSecond);
    }
}
