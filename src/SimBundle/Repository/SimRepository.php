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

    public function findSimOrderByMarque(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s FROM SimBundle:Sim s ORDER BY s.marque ASC'
            )
            ->getResult();
    }

    public function findMarqueSim()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (s.id) as mar , m.marque as smar
                      FROM SimBundle:Sim s 
                      JOIN s.marque m 
                      WHERE s.etat = \'inactif\'
                      GROUP BY m.marque'
            )
            ->getResult();
    }

    public function findSalesByAgent()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT g as ag, count(u.id) as num FROM SimBundle:Sim g JOIN g.agent u GROUP BY u.id'
            )->getResult();
    }
}