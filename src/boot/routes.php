<?php

use Slim\App;
use App\Middleware\AuthMiddleware;
use App\Controller;

return function (App $app) {

    $middleware = new AuthMiddleware($app->getContainer()->get(\League\OAuth2\Server\ResourceServer::class));
    $app->post('/pixel', Controller\PixelTrackingController::class . ":save")->addMiddleware($middleware);

    $app->post('/access_token', Controller\SecurityController::class.":issueAccessToken");

};