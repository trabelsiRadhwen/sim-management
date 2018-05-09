<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 17/04/2018
 * Time: 00:24
 */

namespace SimBundle\Controller;


use SimBundle\Form\AgentComFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use SimBundle\Entity\AgentCommercial;

class AgentComController extends Controller
{
    /**
     * @Route("/agent/agent_commercial/ajouter", name="new_agent_com")
     */
    public function ajouterAction(Request $request){

        $form = $this->createForm(AgentComFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $agent = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();

            $this->addFlash('Success', 'New agent commercial added !');

            return $this->redirectToRoute('agent_com_list');
        }

        return $this->render('agentCom/add.html.twig', [
            'addAgentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/agent/agent_com/{id}/edit", name="edit_agent_com")
     */
    public function editAction(Request $request, AgentCommercial $agentCommercial){

        $form = $this->createForm(AgentComFormType::class, $agentCommercial);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $agentCommercial = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($agentCommercial);
            $em->flush();

            $this->addFlash('Success', 'Agent commercial Updated !');

            return $this->redirectToRoute('agent_com_list');
        }

        return $this->render('agentCom/edit.html.twig', [
            'editAgentForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/agent/agent_commercial/list", name="agent_com_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $agent = $em->getRepository('SimBundle:AgentCommercial')->findAll();

        return $this->render('agentCom/list.html.twig', [
            'agents' => $agent
        ]);
    }

    /**
     * @Route("/agent/agent_com/delete/{id}}", name="agent_com_delete")
     */
    public function deleteSimAction($id){
        $em = $this->getDoctrine()->getManager();
        $agentCom = $em->getRepository('SimBundle:Sim')->find($id);

        $em->remove($agentCom);
        $em->flush();
        $this->addFlash('Success','Agent Commercial deleted !');

        return $this->redirectToRoute('agent_com_list');
    }
}