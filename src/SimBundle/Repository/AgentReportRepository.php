<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 17/04/2018
 * Time: 00:28
 */

namespace SimBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AgentReportRepository extends EntityRepository
{

    public function findAgentReporting(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM SimBundle:AgentReporting a  WHERE a.id BETWEEN 1 AND 5'
            )
            ->getResult();
    }
}