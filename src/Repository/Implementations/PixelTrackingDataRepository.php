<?php


namespace App\Repository\Implementations;


use App\Entity\PixelTrackingData;
use App\Repository\Contracts\PixelTrackingDataRepositoryInterface;
use Doctrine\DBAL\FetchMode;

class PixelTrackingDataRepository  extends BaseRepository implements PixelTrackingDataRepositoryInterface
{

    private $table = 'pixel_tracking_data';

    /**
     * @param array $data
     * @return PixelTrackingData
     */
    public function save(array $data)
    {
        $this->dbConnection->insert($this->table, $data);

        $query =  $this->dbConnection->prepare("SELECT * FROM pixel_tracking_data  WHERE id=:id");
        $query->bindValue('id', $this->dbConnection->lastInsertId());
        $query->execute();
        $query->setFetchMode(FetchMode::CUSTOM_OBJECT, PixelTrackingData::class);

        return $query->fetch();

    }

    /**
     * @param int $userId
     * @return PixelTrackingData|null
     */
    public function findByUserId(int $userId)
    {
        $query =  $this->dbConnection->prepare("SELECT * FROM pixel_tracking_data  WHERE userId=:userId");
        $query->bindValue('userId', $userId);
        $query->execute();
        $query->setFetchMode(FetchMode::CUSTOM_OBJECT, PixelTrackingData::class);

        return $query->fetch();
    }
}