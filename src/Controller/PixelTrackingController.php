<?php
namespace App\Controller;

use App\Errors\DuplicateRecordException;
use App\Service\Contracts\PixelTrackingDataServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PixelTrackingController
{

    /**
     * @var PixelTrackingDataServiceInterface
     */
    private $pixelTrackingDataService;

    /**
     * PixelTrackingController constructor.
     * @param PixelTrackingDataServiceInterface $pixelTrackingDataService
     */
    public function __construct(PixelTrackingDataServiceInterface $pixelTrackingDataService)
    {
        $this->pixelTrackingDataService = $pixelTrackingDataService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function save(Request $request, Response $response)
    {
        $postData = $request->getParsedBody() ?? [];
        try {
            $pixelTrackingData = $this->pixelTrackingDataService->savePixelTrackingData($postData);
            $newResponse = $response->withStatus(201);
            $newResponse->getBody()->write(json_encode($pixelTrackingData));

            return $newResponse;

        } catch (\InvalidArgumentException $exception) {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode([
                "error" => $exception->getMessage()
            ]));

            return $newResponse;
        } catch (DuplicateRecordException $exception) {
            $newResponse = $response->withStatus(401);

            $newResponse->getBody()->write(json_encode([
                "error" => "Record for that user already exist"
            ]));

            return $newResponse;

        } catch (\Throwable $exception) {
            $newResponse = $response->withStatus(500);

            $newResponse->getBody()->write(json_encode([
                "error" => $exception->getMessage()
            ]));

            return $newResponse;

        }

    }

}