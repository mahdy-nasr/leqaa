<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Broadcasts
 *
 * @ORM\Table(name="broadcasts", indexes={@ORM\Index(name="broadcasts_fk0", columns={"user_id"}), @ORM\Index(name="broadcasts_fk1", columns={"convey_id"})})
 * @ORM\Entity
 */
class Broadcasts implements \JsonSerializable
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="convey_id", type="string", length=255, nullable=false)
     */
    private $conveyId;

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getConveyId()
    {
        return $this->conveyId;
    }

    /**
     * @param string $conveyId
     */
    public function setConveyId($conveyId)
    {
        $this->conveyId = $conveyId;
    }







    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }


}

