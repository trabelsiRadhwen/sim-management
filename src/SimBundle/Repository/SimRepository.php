<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 14/04/2018
 * Time: 15:12
 */

namespace SimBundle\Repository;


use Doctrine\ORM\EntityRepository;

class SimRepository extends EntityRepository
{

    public function findSalesMarque()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (s.id) as mar , m.marque as smar
                      FROM SimBundle:Sim s 
                      JOIN s.marque m 
                      WHERE s.etat = \'actif\'
                      GROUP BY m.marque'
            )
            ->getResult();
    }

    public function findSalesPoste()
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT COUNT (a.id) as nb, u.posteRegion as poste
                      FROM SimBundle:Sim a 
                      JOIN a.agent u 
                      where a.etat = 'actif'
                      GROUP BY u.posteRegion"
            )->getResult();
    }

    public function findSalesAgentCom()
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT COUNT (a.id) as nbr, u.nom as nom
                      FROM SimBundle:Sim a 
                      JOIN a.agent u 
                      where a.etat = 'actif'
                      GROUP BY u.nom"
            )->getResult();
    }
}