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
                'SELECT s FROM SimBundle:Sim s  WHERE s.id BETWEEN 1 AND 5 ORDER BY s.marque ASC'
            )
            ->getResult();
    }
}