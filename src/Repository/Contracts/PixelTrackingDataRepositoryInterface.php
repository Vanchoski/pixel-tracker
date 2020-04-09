<?php


namespace App\Repository\Contracts;


use App\Entity\PixelTrackingData;

interface PixelTrackingDataRepositoryInterface
{

    /**
     * @param array $data
     * @return PixelTrackingData
     */
    public function save(array $data);

    /**
     * @param int $userId
     * @return PixelTrackingData|null
     */
    public function findByUserId(int $userId);

}