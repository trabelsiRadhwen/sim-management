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
}