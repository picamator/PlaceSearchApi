<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Model;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Model\ObjectManager;

class ObjectManagerTest extends BaseTest
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManager = new ObjectManager();
    }

    /**
     * @dataProvider providerCreate
     *
     * @param array $arguments
     */
    public function testCreate(array $arguments)
    {
        $className = '\DateTime';

        $actual = $this->objectManager->create($className, $arguments);
        
        $this->assertInstanceOf($className, $actual);
    }

    /**
     * @expectedException \Picamator\PlaceSearchApi\Model\Exception\RuntimeException
     */
    public function testFailCreate()
    {
        $this->objectManager->create('\Picamator\PlaceSearchApi\Model\ObjectManager', [1, 2]);
    }

    public function providerCreate()
    {
        return [
            [['now']],
            [[]]
        ];
    }
}
