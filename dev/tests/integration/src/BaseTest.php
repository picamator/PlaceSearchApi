<?php
namespace Picamator\PlaceSearchApi\Tests\Integration;

use Silex\WebTestCase;
use Silex\Application;

/**
 * Base to share configuration over all tests
 */
abstract class BaseTest extends WebTestCase
{
    /**
     * @var string
     */
    private $endpoint = 'http://place-search.dev:8080';

    /**
     * Create application
     *
     * @return Application
     */
    public function createApplication()
    {
        // init
        $app = require __DIR__ . '/../../../../src/app.php';

        $app['debug'] = true;
        $app['session.test'] = true;
        unset($app['exception_handler']);

        // set fixtures
        /** @var \Symfony\Component\DependencyInjection\ContainerBuilder $di */
        $di = $app['di'];
        $di->set('guzzle_client', $di->get('guzzle_client_mock'));

        return $app;
    }

    /**
     * Retrieve uri
     *
     * @param string $path
     *
     * @return string
     */
    protected function getUri(string $path) : string
    {
        $uri = ltrim($path, '/');

        return $this->endpoint . '/' . $uri;
    }
}
