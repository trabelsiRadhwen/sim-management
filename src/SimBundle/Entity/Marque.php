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
     * @ORM\Column(type="string")
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity="SimBundle\Entity\Sim", mappedBy="marque")
     */
    private $sim;

    public function __construct()
    {
        $this->sim = new ArrayCollection();
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
    public function setSim(Sim $sim)
    {
        $this->sim = $sim;
    }

    public function __toString()
    {
        return $this->getMarque();
    }
}