<?php
namespace Picamator\PlaceSearchApi\Tests\Integration\Resource;

use Picamator\PlaceSearchApi\Tests\Integration\BaseTest;

class BarTest extends BaseTest
{
    public function testGetWithoutParameters()
    {
        $client = $this->createClient();
        $client->followRedirects(true);

        $client->request('GET', $this->getUri('api/bar/'));

        // status
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);

        // content
        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);

        $this->assertGreaterThan(0, $content['count']);
        $this->assertEquals(200, $content['code']);
        foreach($content['data'] as $item) {
            $this->assertNotEmpty($item['id']);
            $this->assertNotEmpty($item['placeId']);
            $this->assertNotEmpty($item['location']);
            $this->assertNotEmpty($item['location']['lat']);
            $this->assertNotEmpty($item['location']['lng']);
            $this->assertNotEmpty($item['name']);
            $this->assertNotEmpty($item['vicinity']);
            $this->assertNotEmpty($item['scope']);
        }
    }

    /**
     * @dataProvider providerNotImplemented
     *
     * @param string $method
     */
    public function testNotImplemented(string $method)
    {
        $client = $this->createClient();
        $client->followRedirects(true);

        $client->request($method, $this->getUri('api/bar/'));

        // status
        $this->assertFalse($client->getResponse()->isOk());
        $this->assertEquals($client->getResponse()->getStatusCode(), 501);

        // content
        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);

        $this->assertNotEmpty($content['msg']);
        $this->assertEquals(501, $content['code']);
    }

    public function providerNotImplemented()
    {
        return [
            ['POST'],
            ['PUT'],
            ['DELETE']
        ];
    }
}
