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
     * @Assert\Length(max="20")
     * @ORM\Column(type="integer")
     */
    private $numeroSerie;

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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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