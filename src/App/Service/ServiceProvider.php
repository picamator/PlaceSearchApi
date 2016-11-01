<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Service;

use Picamator\PlaceSearchApi\App\Controller\ErrorController;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpFoundation\Request;

/**
 * Initiate main services
 *
 * @codeCoverageIgnore
 */
class ServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $configPath = __DIR__ . '/../../../config/services.yml';

    /**
     * {@inheritdoc}
     */
    public function register(Container $pimple)
    {
        // DI
        $pimple['di'] =  function() {
            $container  = new ContainerBuilder();
            $loader     = new YamlFileLoader($container, new FileLocator(__DIR__));
            $loader->load(self::$configPath);

            return $container;
        };

        // error controller
        $pimple['error_controller'] = function () {
            return new ErrorController();
        };
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        // Error handlers
        $app->error(function (\Exception $e, Request $request, $code) use ($app) {

            /** @var ErrorController $errorController */
            $errorController = $app['error_controller'];
            if ($code === 404) {
                return $errorController->getNotFound($request, $app, $e, $code);
            }

            return $errorController->getInternalServer($request, $app, $e, $code);
        });
    }
}
