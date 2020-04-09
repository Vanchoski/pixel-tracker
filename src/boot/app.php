<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Slim\Factory\AppFactory;

$containerBuilder = include __DIR__."/container.php";

AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

(require __DIR__ . '/routes.php')($app);


return $app;