<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Error controller
 */
class ErrorController
{
    /**
     * Not implemented
     *
     * @param Request       $request
     * @param Application   $app
     *
     * @return JsonResponse
     */
    public function getNotImplemented(Request $request, Application $app)
    {
        /** @var \Picamator\PlaceSearchApi\App\Service\Error\NotImplementedService $service */
        $service = $app['di']->get('app_error_not_implemented_service');

        $response = $service->execute();

        return $app->json($response, 501);
    }

    /**
     * Not implemented
     *
     * @param Request       $request
     * @param Application   $app
     *
     * @return JsonResponse
     */
    public function getNotFound(Request $request, Application $app)
    {
        /** @var \Picamator\PlaceSearchApi\App\Service\Error\NotFoundService $service */
        $service = $app['di']->get('app_error_not_found_service');

        $response = $service->execute();

        return $app->json($response, 404);
    }

    /**
     * Internal server
     *
     * @param Request       $request
     * @param Application   $app
     *
     * @return JsonResponse
     */
    public function getInternalServer(Request $request, Application $app)
    {
        /** @var \Picamator\PlaceSearchApi\App\Service\Error\InternalServerService $service */
        $service = $app['di']->get('app_internal_server_service');

        $response = $service->execute();

        return $app->json($response, 500);
    }
}
