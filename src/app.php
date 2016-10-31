<?php
use Picamator\PlaceSearchApi\App\Service\ServiceProvider;
use Picamator\PlaceSearchApi\App\Controller\Provider\IndexProvider;
use Picamator\PlaceSearchApi\App\Controller\Provider\BarProvider;

// app
$app = new Silex\Application();

// service register
$app->register(new ServiceProvider());

// route
$app->mount('/', new IndexProvider());
$app->mount('/api/v1/bar', new BarProvider());

return $app;
