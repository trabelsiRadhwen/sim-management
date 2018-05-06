<?php

namespace SimBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     */
    public function IndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sims = $em->getRepository('SimBundle:Sim')->findSimOrderByMarque();

        $offres = $em->getRepository('SimBundle:Offre')->findOffreOrderAsc();

        $agentsCom = $em->getRepository('SimBundle:AgentCommercial')->findAgentComOrderByPosteRegion();

        $agentsReport = $em->getRepository('SimBundle:AgentReporting')->findAgentReporting();

        return $this->render('base.html.twig', [
            'sims' => $sims,
            'offres' => $offres,
            'agentsCom' => $agentsCom,
            'agentsReport' => $agentsReport
        ]);
    }
}
