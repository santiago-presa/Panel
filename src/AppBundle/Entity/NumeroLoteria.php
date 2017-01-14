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
 * @ORM\Table(name="NumerosLoteria")
 * @ORM\Entity
 */
class NumeroLoteria implements \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
      */
    private $numero1;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
     *
     */
    private $numero2;
    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
     */
    private $numero3;
    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
     */
    private $numero4;
    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
     */
    private $numero5;
    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
     */
    private $estrella1;
    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 0,
     *      max = 13,
     *      minMessage = "Debe ser mayor que {{ limit }}",
     *      maxMessage = "Debe ser menor que {{ limit }}"
     * )
     */
    private $estrella2;
    /**
     * @ORM\Column(type="smallint",nullable=true)
     *
     * @Assert\Blank()
     */
    private $numVeces;

    /**
     * @return mixed
     */
    public function getNumVeces()
    {
        return $this->numVeces;
    }

    /**
     * @param mixed $numVeces
     */
    public function setNumVeces($numVeces)
    {
        $this->numVeces = $numVeces;
    }
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
    public function getNumero1()
    {
        return $this->numero1;
    }

    /**
     * @param mixed $numero1
     */
    public function setNumero1($numero1)
    {
        $this->numero1 = $numero1;
    }

    /**
     * @return mixed
     */
    public function getNumero2()
    {
        return $this->numero2;
    }

    /**
     * @param mixed $numero2
     */
    public function setNumero2($numero2)
    {
        $this->numero2 = $numero2;
    }

    /**
     * @return mixed
     */
    public function getNumero3()
    {
        return $this->numero3;
    }

    /**
     * @param mixed $numero3
     */
    public function setNumero3($numero3)
    {
        $this->numero3 = $numero3;
    }

    /**
     * @return mixed
     */
    public function getNumero4()
    {
        return $this->numero4;
    }

    /**
     * @param mixed $numero4
     */
    public function setNumero4($numero4)
    {
        $this->numero4 = $numero4;
    }

    /**
     * @return mixed
     */
    public function getNumero5()
    {
        return $this->numero5;
    }

    /**
     * @param mixed $numero5
     */
    public function setNumero5($numero5)
    {
        $this->numero5 = $numero5;
    }
    /**
     * @return mixed
     */
    public function getEstrella1()
    {
        return $this->estrella1;
    }

    /**
     * @param mixed $estrella1
     */
    public function setEstrella1($estrella1)
    {
        $this->estrella1 = $estrella1;
    }

    /**
     * @return mixed
     */
    public function getEstrella2()
    {
        return $this->estrella2;
    }

    /**
     * @param mixed $estrella2
     */
    public function setEstrella2($estrella2)
    {
        $this->estrella2 = $estrella2;
    }

    public function __construct()
    {
       // $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }
    public function crear($numero1,$numero2,$numero3,$numero4,$numero5,$estrella1,$estrella2)
    {
            $this->numero1=$numero1;
            $this->numero2=$numero2;
            $this->numero3=$numero3;
            $this->numero4=$numero4;
            $this->numero5=$numero5;
            $this->estrella1=$estrella1;
            $this->estrella2=$estrella2;
        // $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }


    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->numero1,
            $this->numero2,
            $this->numero3,
            $this->numero4,
            $this->numero5,
            $this->estrella1,
            $this->estrella2,
            // see section on salt below
            // $this->salt,
        ));
    }
    public function print(){
        return $this->numero1." - ".$this->numero2." - ".$this->numero3." - ".$this->numero4." - ".$this->numero5." - ".$this->estrella1." - ".$this->estrella2;
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->numero1,
            $this->numero2,
            $this->numero3,
            $this->numero4,
            $this->numero5,
            $this->estrella1,
            $this->estrella2,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }


}
