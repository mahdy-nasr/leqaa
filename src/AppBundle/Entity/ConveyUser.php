<?php
/**
 * Created by PhpStorm.
 * User: mahdynasr
 * Date: 03/08/18
 * Time: 12:56 AM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="convey_user")
 */
class ConveyUser
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    private $user_id;

    private $convery_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getConveryId()
    {
        return $this->convery_id;
    }

    /**
     * @param mixed $convery_id
     */
    public function setConveryId($convery_id)
    {
        $this->convery_id = $convery_id;
    }

}