<?php
use \App\Repository\Implementations\ClientRepository;
use \App\Repository\Implementations\AccessTokenRepository;
use \App\Repository\Implementations\ScopeRepository;
use \League\OAuth2\Server\AuthorizationServer;
use \Doctrine\DBAL\Driver\Connection;
use \League\OAuth2\Server\Grant\ClientCredentialsGrant;

return function (\Psr\Container\ContainerInterface $container){
    $settings = include __DIR__."/../config/auth.php";
    $clientRepository = new ClientRepository($container->get(Connection::class));
    $accessTokenRepository = new AccessTokenRepository($container->get(Connection::class));
    $scopeRepository = new ScopeRepository($container->get(Connection::class));
    $server = new AuthorizationServer(
        $clientRepository,
        $accessTokenRepository,
        $scopeRepository,
        $settings['private_key_path'],
        $settings['encryption_key']
    );

    $grant =  new ClientCredentialsGrant();
    $grant->setDefaultScope('client');
    $server->enableGrantType(
        $grant,
        new \DateInterval('PT1H') // access tokens will expire after 1 hour
    );
    return $server;
};