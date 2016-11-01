<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Bar controller
 */
class BarController
{
    /**
     * GET:/bar
     *
     * @param Request       $request
     * @param Application   $app
     *
     * @return JsonResponse
     */
    public function getBar(Request $request, Application $app)
    {
        /** @var \Picamator\PlaceSearchApi\App\Service\Place\GetService $service */
        $service = $app['di']->get('app_place_get_service');

        /** @var \Picamator\PlaceSearchApi\Search\Api\ConfigInterface $config */
        $config = $app['di']->get('search_config');

        $data = [
           'key'        => $config->search('http_client_place', 'key'),
           'type'       => $config->search('http_client_place', 'parameters', 'type'),
           'location'   => $request->get('location',    $config->search('http_client_place', 'parameters', 'location')),
           'radius'     => $request->get('radius',      $config->search('http_client_place', 'parameters', 'radius')),
           'language'   => $request->get('language',    $config->search('http_client_place', 'parameters', 'language')),
        ];

        $response = $service->execute($data);

        return $app->json($response, 200);
    }
}
