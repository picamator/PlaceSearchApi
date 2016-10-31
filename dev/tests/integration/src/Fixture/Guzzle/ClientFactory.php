<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Tests\Integration\Fixture\Guzzle;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Build client
 *
 * @todo simplify factory
 *
 * @codeCoverageIgnore
 */
class ClientFactory
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $path = __DIR__ . '/../data/google.bar.json';

    /**
     * @return ClientInterface
     */
    public static function create() : ClientInterface
    {
        $fixtureStream = fopen(self::$path, 'r');

        $response   = new Response(200, [], $fixtureStream);
        $mock       = new MockHandler([$response]);
        $handler    = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}
