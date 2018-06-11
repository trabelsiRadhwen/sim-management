<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 17/04/2018
 * Time: 00:24
 */

namespace SimBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AgentComRepository extends EntityRepository
{

    public function findAgentComOrderByPosteRegion(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM SimBundle:AgentCommercial a  WHERE a.id BETWEEN 1 AND 5 ORDER BY a.posteRegion ASC'
            )
            ->getResult();
    }

    public function findAgentByPoste()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a.posteRegion as region FROM SimBundle:AgentCommercial a GROUP BY a.posteRegion'
            )
            ->getResult();
    }


}