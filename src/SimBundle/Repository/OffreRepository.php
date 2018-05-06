<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 16/04/2018
 * Time: 00:04
 */

namespace SimBundle\Repository;


use Doctrine\ORM\EntityRepository;

class OffreRepository extends EntityRepository
{

    public function findOffreOrderAsc(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f FROM SimBundle:Offre f WHERE f.id BETWEEN 1 AND 5'
            )
            ->getResult();
    }
}