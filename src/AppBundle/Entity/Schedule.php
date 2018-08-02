<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule", indexes={@ORM\Index(name="schedule_fk0", columns={"convey_id"})})
 * @ORM\Entity
 */
class Schedule implements \JsonSerializable
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Convey
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Convey")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="convey_id", referencedColumnName="id")
     * })
     */
    private $convey;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return Convey
     */
    public function getConvey()
    {
        return $this->convey;
    }

    /**
     * @param Convey $convey
     */
    public function setConvey($convey)
    {
        $this->convey = $convey;
    }


    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }


}

