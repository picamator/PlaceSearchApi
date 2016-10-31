<?php
namespace Picamator\PlaceSearchApi\Tests\Integration\Resource;

use Picamator\PlaceSearchApi\Tests\Integration\BaseTest;

class ErrorTest extends BaseTest
{
    public function test404Page()
    {
        $client = $this->createClient();
        $client->followRedirects(true);

        $client->request('GET', $this->getUri('wrong-url'));

        // status
        $this->assertFalse($client->getResponse()->isOk());
        $this->assertEquals($client->getResponse()->getStatusCode(), 404);

        // content
        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);

        $this->assertNotEmpty($content['msg']);
        $this->assertEquals(404, $content['code']);
    }
}
