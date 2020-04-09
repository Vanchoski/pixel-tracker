<?php


namespace App\Entity;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;

class ClientEntity implements ClientEntityInterface
{

    use ClientTrait;

    private $id;
    private $secret;


    public function setId($id)
    {
        $this->id = $id;

    }

    public function setSecret($secret)
    {
        $this->secret = $secret;

    }

    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * Get the client's identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->id;
    }



    /**
     * Returns the registered redirect URI (as a string).
     *
     * Alternatively return an indexed array of redirect URIs.
     *
     * @return string|string[]
     */
    public function getRedirectUri()
    {
       return '';
    }
}