<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Handler;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use \Picamator\PlaceSearchApi\Search\Handler\Cache;

class CacheTest extends BaseTest
{
    /**
     * @var Cache
     */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $this->handler = new Cache();
    }

    public function testHandle()
    {
        $actual = $this->handler->handle([]);
        $this->assertNull($actual);
    }
}
