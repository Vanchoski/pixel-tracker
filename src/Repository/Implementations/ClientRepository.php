<?php

namespace App\Repository\Implementations;


use App\Entity\ClientEntity;
use Doctrine\DBAL\FetchMode;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{

    /**
     * Get a client.
     *
     * @param string $clientIdentifier The client's identifier
     *
     * @return ClientEntityInterface|null
     */
    public function getClientEntity($clientIdentifier)
    {

        $query = $this->dbConnection->prepare('SELECT * FROM api_clients WHERE id=:id');
        $query->bindValue('id', $clientIdentifier);
        $query->execute();
        $query->setFetchMode(FetchMode::CUSTOM_OBJECT, ClientEntity::class);

        return $query->fetch();

    }

    /**
     * Validate a client's secret.
     *
     * @param string $clientIdentifier The client's identifier
     * @param null|string $clientSecret The client's secret (if sent)
     * @param null|string $grantType The type of grant the client is using (if sent)
     *
     * @return bool
     */
    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {

        $query = $this->dbConnection->prepare('SELECT * FROM api_clients WHERE id=:id and secret = :secret');
        $query->bindValue('id', $clientIdentifier);
        $query->bindValue('secret', $clientSecret);
        $query->execute();
        $query->setFetchMode(FetchMode::CUSTOM_OBJECT, ClientEntity::class);


        $client =  $query->fetch();

        return empty($client) ? false : true;
    }
}