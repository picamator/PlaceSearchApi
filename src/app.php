<?php
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Picamator\PlaceSearchApi\App\Controller\Provider\BarProvider;

$app = new Silex\Application();

// DI container
$app['di'] =  function() {
    $container  = new ContainerBuilder();
    $loader     = new YamlFileLoader($container, new FileLocator(__DIR__));
    $loader->load(__DIR__ . '/../config/services.yml');

    return $container;
};

// route
$app->mount('/api/bar', new BarProvider());

return $app;
