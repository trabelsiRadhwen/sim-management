<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 22/05/2018
 * Time: 02:22
 */

namespace SimBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use function intval;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="numero_appel")
 */
class NumeroAppel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="8")
     * @ORM\Column(type="string")
     */
    private $numeroAppel;

    /**
     * @ORM\ManyToOne(targetEntity="SimBundle\Entity\Marque", inversedBy="numeroAppel")\
     * @ORM\JoinColumn(name="id_marque", referencedColumnName="id", nullable=true)
     */
    private $marque;


    /**
     * @ORM\OneToMany(targetEntity="SimBundle\Entity\Sim", mappedBy="numeroAppel")
     */
    private $sim;

    public function __construct()
    {
        $this->sim = new ArrayCollection();
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
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getSim()
    {
        return $this->sim;
    }

    /**
     * @param mixed $sim
     */
    public function setSim($sim)
    {
        $this->sim = $sim;
    }

    public function __toString()
    {
        return $this->getNumeroAppel();
    }

    /**
     * @return mixed
     */
    public function getNumeroAppel()
    {
        return $this->numeroAppel;
    }

    /**
     * @param mixed $numeroAppel
     */
    public function setNumeroAppel($numeroAppel)
    {
        $this->numeroAppel = $numeroAppel;
    }
}