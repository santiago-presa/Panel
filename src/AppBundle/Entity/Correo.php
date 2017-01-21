<?php
/**
 * Created by PhpStorm.
 * User: rubsan
 * Date: 31/12/2016
 * Time: 12:06
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="Correos")
 * @ORM\Entity
 */
class Correo implements \Serializable
{
    /**
     * @ORM\Column(type="integer")

     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @ORM\Column(name="para")
     * @ORM\Column(length=50)
     * @Assert\NotBlank()
      */
    private $para;

    /**
     * @ORM\Column(type="text")
     * @ORM\Column(name="desde")
     * @ORM\Column(length=50)
     * @Assert\NotBlank()
     */
    private $desde;
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @ORM\Column(length=250)
     */
    private $asunto;
    /**
     * @ORM\Column(type="text")
     * @ORM\Column(length=1000)
     */
    private $descripcion;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPara()
    {
        return $this->para;
    }

    /**
     * @param mixed $para
     */
    public function setPAra($para)
    {
        $this->para = $para;
    }

    /**
     * @return mixed
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * @param mixed $desde
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;
    }

    /**
     * @return mixed
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param mixed $asunto
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function __construct()
    {
       // $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->to,
            $this->asunto,
            $this->descripcion,
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->to,
            $this->asunto,
            $this->descripcion,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }


}
