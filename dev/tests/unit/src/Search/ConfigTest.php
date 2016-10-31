<?php
namespace Picamator\PlaceSearchApi\Tests\Unit\Search;

use Picamator\PlaceSearchApi\Tests\Unit\BaseTest;
use Picamator\PlaceSearchApi\Search\Config;

class ConfigTest extends BaseTest
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testNoArgumentsSearch()
    {
        $data = [1, 2, 3];

        $config = new Config($data);
        $actual = $config->search();

        $this->assertEquals($data, $actual);
    }

    /**
     * @dataProvider providerSearch
     *
     * @param array $data
     * @param array $arguments
     * @param mixed $expected
     */
    public function testSearch(array $data, array $arguments, $expected)
    {
        $config = new Config($data);
        $actual = call_user_func_array([$config, 'search'], $arguments);

        $this->assertEquals($expected, $actual);
    }

    public function providerSearch()
    {
        return [
            [
                ['test' => ['value' => 1]],
                ['test', 'value'],
                1
            ], [
                ['test' => 1],
                ['test'],
                1
            ], [
                [],
                ['test'],
                null
            ], [
                ['test' => 1],
                ['invalidKey'],
                null
            ]
        ];
    }
}