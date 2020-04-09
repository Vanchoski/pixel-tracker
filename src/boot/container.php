<?php

use DI\ContainerBuilder;
use \Psr\Container\ContainerInterface;
use \Doctrine\DBAL\Driver\Connection;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    'settings' => [
        'displayErrorDetails' => true,

    ],
]);

$containerBuilder->addDefinitions([
    \Doctrine\DBAL\Driver\Connection::class => function () {
    $settings = include __DIR__."/../config/db.php";
        return \Doctrine\DBAL\DriverManager::getConnection($settings);
    },
    \App\Repository\Contracts\PixelTrackingDataRepositoryInterface::class => function (ContainerInterface $container) {

        return new \App\Repository\Implementations\PixelTrackingDataRepository($container->get(Connection::class));
    },
    \App\Service\Contracts\PixelTrackingDataServiceInterface::class => function (ContainerInterface $container) {

        return new \App\Service\Implementations\PixelTrackingDataService($container->get(\App\Repository\Contracts\PixelTrackingDataRepositoryInterface::class));
    },

    \League\OAuth2\Server\AuthorizationServer::class => function (ContainerInterface $container) {
        return (require __DIR__ . '/auth.php')($container);
    },
    \League\OAuth2\Server\ResourceServer::class => function(ContainerInterface $container) {

        $settings = include __DIR__."/../config/auth.php";

         $accessTokenRepository = new \App\Repository\Implementations\AccessTokenRepository($container->get(\Doctrine\DBAL\Driver\Connection::class));

        // Setup the authorization server
        $server = new \League\OAuth2\Server\ResourceServer(
            $accessTokenRepository,
            $settings['public_key_path']
        );

        return $server;
    }


]);

return $containerBuilder;