<?php


namespace App\Service\Contracts;

use App\Entity\PixelTrackingData;

interface PixelTrackingDataServiceInterface
{

    public function savePixelTrackingData(array $data);



}