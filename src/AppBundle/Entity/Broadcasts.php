<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Broadcasts
 *
 * @ORM\Table(name="broadcasts", indexes={@ORM\Index(name="broadcasts_fk0", columns={"user_id"}), @ORM\Index(name="broadcasts_fk1", columns={"convey_id"})})
 * @ORM\Entity
 */
class Broadcasts
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
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \AppBundle\Entity\Convey
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Convey")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="convey_id", referencedColumnName="id")
     * })
     */
    private $convey;


}

