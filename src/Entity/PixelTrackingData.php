<?php

namespace App\Entity;

class PixelTrackingData implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $pixelType;

    /**
     * @var int
     */
    private $occurredOn;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getPixelType()
    {
        return $this->pixelType;
    }

    /**
     * @param string $pixelType
     */
    public function setPixelType($pixelType)
    {
        $this->pixelType = $pixelType;
    }

    /**
     * @return int
     */
    public function getOccurredOn()
    {
        return $this->occurredOn;
    }

    /**
     * @param int $occurredOn
     */
    public function setOccurredOn($occurredOn)
    {
        $this->occurredOn = $occurredOn;
    }


    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}