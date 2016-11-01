<?php
namespace Picamator\PlaceSearchApi\Tests\Integration\Resource;

use Picamator\PlaceSearchApi\Tests\Integration\BaseTest;

class IndexTest extends BaseTest
{
    public function testGetWithoutParameters()
    {
        $client = $this->createClient();
        $client->followRedirects(true);

        $client->request('GET', $this->getUri());

        // status
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
    }
}
