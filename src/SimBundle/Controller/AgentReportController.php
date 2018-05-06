<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 17/04/2018
 * Time: 00:26
 */

namespace SimBundle\Controller;


use SimBundle\Entity\AgentReporting;
use SimBundle\Form\AgentReportFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AgentReportController extends Controller
{

    /**
     * @Route("/agent/agent_report/ajouter", name="new_agent_report")
     */
    public function ajouterAction(Request $request){

        $form = $this->createForm(AgentReportFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $agent = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();

            $this->addFlash('Success', 'New agent report added !');

            return $this->redirectToRoute('agent_report_list');
        }

        return $this->render('agentReport/add.html.twig', [
            'addAgentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/agent/agent_report/{id}/edit", name="edit_agent_report")
     */
    public function editAction(Request $request, AgentReporting $agentReporting){

        $form = $this->createForm(AgentReportFormType::class, $agentReporting);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $agentReporting = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($agentReporting);
            $em->flush();

            $this->addFlash('Success', 'agent reporting Updated !');

            return $this->redirectToRoute('agent_report_list');
        }

        return $this->render('agentReport/edit.html.twig', [
            'editAgentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/agent/agent_report/list", name="agent_report_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $agent = $em->getRepository('SimBundle:AgentReporting')->findAll();

        return $this->render('agentReport/list.html.twig', [
            'agents' => $agent
        ]);
    }
}