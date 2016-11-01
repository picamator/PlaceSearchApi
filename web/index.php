<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../src/app.php';

$app['debug'] = (bool) getenv('PLACE_SEARCH_API_DEBUG');

$app->run();
