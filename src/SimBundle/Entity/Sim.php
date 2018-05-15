<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 14/04/2018
 * Time: 15:12
 */

namespace SimBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="SimBundle\Repository\SimRepository")
 * @ORM\Table(name="sim")
 */
class Sim
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="10")
     * @ORM\Column(type="integer")
     */
    private $numeroSerie;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="8",max="8")
     * @ORM\Column(type="integer")
     */
    private $numeroAppel;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $etat;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="SimBundle\Entity\Marque", inversedBy="sim")
     */
    private $marque;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="SimBundle\Entity\Offre", inversedBy="sim")
     */
    private $offre;

    /**
     * @ORM\ManyToOne(targetEntity="SimBundle\Entity\AgentCommercial", inversedBy="sim")
     */
    private $agent;

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
    public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }

    /**
     * @param mixed $numeroSerie
     */
    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;
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
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
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

    /**
     * @return mixed
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param mixed $agent
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    }
}