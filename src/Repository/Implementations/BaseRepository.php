<?php


namespace App\Repository\Implementations;

use Doctrine\DBAL\Driver\Connection;

class BaseRepository
{

    /**
     * @var Connection
     */
    protected $dbConnection;

    /**
     * BaseRepository constructor.
     * @param Connection $dbConnection
     */
    public function __construct(Connection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

}