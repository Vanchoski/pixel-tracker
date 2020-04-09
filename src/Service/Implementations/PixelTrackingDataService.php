<?php

namespace App\Service\Implementations;

use App\Entity\PixelTrackingData;
use App\Errors\DuplicateRecordException;
use App\Repository\Contracts\PixelTrackingDataRepositoryInterface;
use App\Service\Contracts\PixelTrackingDataServiceInterface;

class PixelTrackingDataService implements PixelTrackingDataServiceInterface
{
    private $pixelTrackingDataRepository;
    const PIXEL_TYPES = [
        "PIXEL_SOI",
        "PIXEL_DOI",
    ];

    public function __construct(PixelTrackingDataRepositoryInterface $pixelTrackingDataRepository)
    {
        $this->pixelTrackingDataRepository = $pixelTrackingDataRepository;
    }

    /**
     * @param array $data
     * @return PixelTrackingData
     * @throws DuplicateRecordException
     */
    public function savePixelTrackingData(array $data)
    {
       if (empty($data['userId']) || !is_int($data['userId'])) {
           throw  new \InvalidArgumentException("Invalid argument for userId");
       }
       if(empty($data['portalId']) || !is_int($data['portalId'])) {
           throw  new \InvalidArgumentException("Invalid argument for portalId");
       }
       if(empty($data['occurredOn']) || !is_int($data['occurredOn'])) {
           throw  new \InvalidArgumentException("Invalid argument for occurredOn");
       }
       if(empty($data['pixelType']) || !in_array($data['pixelType'], self::PIXEL_TYPES)) {
           throw  new \InvalidArgumentException("Invalid argument for pixelType");
       }

        $pixelTrackingData = $this->pixelTrackingDataRepository->findByUserId($data['userId']);
        if ($pixelTrackingData) {

            throw new DuplicateRecordException();
        }

       return $this->pixelTrackingDataRepository->save($data);

    }
}