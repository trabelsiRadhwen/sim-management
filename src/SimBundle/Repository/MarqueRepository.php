<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 08/05/2018
 * Time: 01:19
 */

namespace SimBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MarqueRepository extends EntityRepository
{

    public function findMarque(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m FROM SimBundle:Marque m  WHERE m.id BETWEEN 1 AND 5 ORDER BY m.marque ASC'
            )
            ->getResult();
    }
}