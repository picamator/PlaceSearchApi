<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Controller\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

/**
 * Index provider
 *
 * @codeCoverageIgnore
 */
class IndexProvider implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // routing
        /** @var \Silex\ControllerCollection $bar */
        $bar = $app['controllers_factory'];

        $bar->get('/', 'Picamator\\PlaceSearchApi\\App\\Controller\\IndexController::index');

        // not implemented
        $bar->post('/', 'Picamator\\PlaceSearchApi\\App\\Controller\\ErrorController::getNotImplemented');
        $bar->put('/', 'Picamator\\PlaceSearchApi\\App\\Controller\\ErrorController::getNotImplemented');
        $bar->delete('/', 'Picamator\\PlaceSearchApi\\App\\Controller\\ErrorController::getNotImplemented');

        return $bar;
    }
}
