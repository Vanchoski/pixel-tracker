<?php


namespace App\Repository\Implementations;


use App\Entity\ScopeEntity;
use Doctrine\DBAL\FetchMode;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository extends BaseRepository  implements ScopeRepositoryInterface
{

    /**
     * Return information about a scope.
     *
     * @param string $identifier The scope identifier
     *
     * @return ScopeEntityInterface|null
     */
    public function getScopeEntityByIdentifier($identifier)
    {
        $query = $this->dbConnection->prepare('SELECT * FROM scopes WHERE name=:name');
        $query->bindValue('name', $identifier);
        $query->execute();
        $query->setFetchMode(FetchMode::CUSTOM_OBJECT, ScopeEntity::class);

        return $query->fetch();
    }

    /**
     * Given a client, grant type and optional user identifier validate the set of scopes requested are valid and optionally
     * append additional scopes or remove requested scopes.
     *
     * @param ScopeEntityInterface[] $scopes
     * @param string $grantType
     * @param ClientEntityInterface $clientEntity
     * @param null|string $userIdentifier
     *
     * @return ScopeEntityInterface[]
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        $filteredScopes = [];
        /**
         * Check which scopes the client has
         */
        foreach ($scopes as $scope) {
            $query = $this->dbConnection->prepare('SELECT * FROM api_client_scopes WHERE scope_id=:scope_id AND client_id = :client_id');

            $scopeId = $scope->getIdentifier();
            $clientId = $scope->getIdentifier();
            $query->bindValue('scope_id',$scopeId);
            $query->bindValue('client_id',$clientId);
            $query->execute();

            $scopeRow = $query->fetch();
            if($scopeRow) {
                $filteredScopes[] = $scope;
            }

        }

        return $filteredScopes;
    }
}