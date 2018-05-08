<?php

namespace SimBundle\Controller;

use function count;
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

        $allSims = $em->getRepository('SimBundle:Sim')->findAll();

        $allAgentsCom = $em->getRepository('SimBundle:AgentCommercial')->findAll();

        $allOffres = $em->getRepository('SimBundle:Offre')->findAll();

        $offres = $em->getRepository('SimBundle:Offre')->findOffreOrderAsc();

        $agentsCom = $em->getRepository('SimBundle:AgentCommercial')->findAgentComOrderByPosteRegion();

        $agentsReport = $em->getRepository('SimBundle:AgentReporting')->findAgentReporting();

        $marque = $em->getRepository('SimBundle:Marque')->findMarque();

        return $this->render('base.html.twig', [
            'sims' => $sims,
            'offres' => $offres,
            'agentsCom' => $agentsCom,
            'agentsReport' => $agentsReport,
            'countSims' => count($allSims),
            'countAgentCom' => count($allAgentsCom),
            'countMarque' => count($marque),
            'countOffres' => count($allOffres)
        ]);
    }
}
