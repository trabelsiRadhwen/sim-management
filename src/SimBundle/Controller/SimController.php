<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 14/04/2018
 * Time: 12:36
 */

namespace SimBundle\Controller;

use mysqli;
use function mysqli_query;
use SimBundle\Entity\AgentCommercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SimBundle\Entity\Marque;
use SimBundle\Entity\Offre;
use SimBundle\Entity\Sim;
use SimBundle\Form\SimFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SimController extends Controller
{

    /**
     * @Route("sim/new")
     */
    public function ajouterAction(){

        $marque = new Marque();
        $marque->setMarque('Taraji mobile');

        $offre = new Offre();
        $offre->setOffre('1000% Bonus');
        $offre->setDescription('Avec l"offre 1000% bonus vous pouvez.......');

        $agent = new AgentCommercial();
        $agent->setUsername('agentCom_1_Sousse');
        $agent->setPassword('dnvknvk');
        $agent->setNom('jnvjnfvjf');
        $agent->setPrenom('kdmvkdmv');
        $agent->setEmail('jdncjdnc@kkdmnc.com');
        $agent->setTel('2654+6364564');
        $agent->setPosteRegion('Sousse');

        $sim = new Sim();
        $sim->setNumeroSerie('000001245');
        $sim->setNumeroAppel('90637852');
        $sim->setEtat('Inactif');

        $sim->setMarque($marque);

        $sim->setOffre($offre);

        $sim->setAgent($agent);

        $em = $this->getDoctrine()->getManager();
        $em->persist($sim);
        $em->persist($marque);
        $em->persist($offre);
        $em->persist($agent);
        $em->flush();

        return new Response(
            'Sim saved');

    }

    /**
     * @Route("/sim/ajouter", name="new_sim")
     */
    public function newAction(Request $request){

        $form = $this->createForm(SimFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $sim = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($sim);
            $em->flush();

            $this->addFlash('Success', 'New Sim added !');

            return $this->redirectToRoute('sim_list');
        }

        return $this->render('sim/add.html.twig', [
            'addSimForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/sim/{id}/edit", name="edit_sim")
     */
    public function editAction(Request $request, Sim $sim){

        $form = $this->createForm(SimFormType::class, $sim);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $sim = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($sim);
            $em->flush();

            $this->addFlash('Success', 'Sim Updated !');

            return $this->redirectToRoute('sim_list');
        }

        return $this->render('sim/edit.html.twig', [
            'editSimForm' => $form->createView()
        ]);
    }


    /**
     * @Route("sim/list", name="sim_list")
     */
    public function listeAction(){
        $em = $this->getDoctrine()->getManager();
        $sims = $em->getRepository('SimBundle\Entity\Sim')->findAll();

        return $this->render('sim/list.html.twig', [
            'sims' => $sims,
        ]);
    }

    /**
     * @Route("/sim/delete/{id}}", name="sim_delete")
     */
    public function deleteSimAction($id){
        $em = $this->getDoctrine()->getManager();
        $sim = $em->getRepository('SimBundle:Sim')->find($id);

        $em->remove($sim);
        $em->flush();
        $this->addFlash('Success','Sim Removed!');

        return $this->redirectToRoute('sim_list');
    }
}