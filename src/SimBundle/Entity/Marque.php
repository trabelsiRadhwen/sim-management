<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 14/04/2018
 * Time: 15:13
 */

namespace SimBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="SimBundle\Repository\MarqueRepository")
 * @ORM\Table(name="marque")
 */
class Marque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity="SimBundle\Entity\Offre", mappedBy="marque", cascade={"persist"})
     */
    private $offre;

    /**
     * @ORM\OneToMany(targetEntity="SimBundle\Entity\NumeroAppel", mappedBy="marque")
     */
    private $numeroAppel;

    /**
     * @ORM\OneToMany(targetEntity="SimBundle\Entity\Sim", mappedBy="marque")
     */
    private $sim;

    public function __construct()
    {
        $this->numeroAppel = new ArrayCollection();
        $this->offre = new ArrayCollection();
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
    public function setSim(Sim $sim)
    {
        $this->sim = $sim;
    }

    /**
     * @return mixed
     */
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * @param mixed $offre
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;
    }

    public function __toString()
    {
        return $this->getMarque();
    }
}