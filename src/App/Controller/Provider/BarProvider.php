<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Controller\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

/**
 * Bar provider
 *
 * @codeCoverageIgnore
 */
class BarProvider implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // routing
        $bar = $app["controllers_factory"];

        $bar->get("/", "Picamator\\PlaceSearchApi\\App\\Controller\\BarController::getBar");

        // not implemented
        $bar->post("/", "Picamator\\PlaceSearchApi\\App\\Controller\\ErrorController::getNotImplemented");
        $bar->put("/", "Picamator\\PlaceSearchApi\\App\\Controller\\ErrorController::getNotImplemented");
        $bar->delete("/", "Picamator\\PlaceSearchApi\\App\\Controller\\ErrorController::getNotImplemented");

        return $bar;
    }
}
