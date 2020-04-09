<?php


namespace App\Controller;


use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SecurityController
{
    /**
     * @var AuthorizationServer
     */
    private $authorizationServer;

    /**
     * SecurityController constructor.
     * @param AuthorizationServer $authorizationServer
     */
    public function __construct(AuthorizationServer $authorizationServer)
    {
        $this->authorizationServer = $authorizationServer;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function issueAccessToken(ServerRequestInterface $request, ResponseInterface $response)
    {

        try {
            return $this->authorizationServer->respondToAccessTokenRequest($request, $response);

        } catch (\League\OAuth2\Server\Exception\OAuthServerException $exception) {

            return $exception->generateHttpResponse($response);

        } catch (\Throwable $exception) {
            $newResponse = $response->withStatus(500);

            $newResponse->getBody()->write(json_encode([
                "error" => "Internal Server error"
            ]));

            return $newResponse;

        }
    }
}