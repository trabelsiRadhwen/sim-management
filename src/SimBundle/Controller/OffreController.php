<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 17/04/2018
 * Time: 13:54
 */

namespace SimBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use SimBundle\Entity\Offre;
use SimBundle\Form\OffreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffreController extends Controller
{

    /**
     * @Route("/sim/offre/ajouter", name="new_offre")
     */
    public function ajouterAction(Request $request){

        $form = $this->createForm(OffreFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $offre = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            $this->addFlash('Success', 'New offre added !');

            return $this->redirectToRoute('offre_list');
        }

        return $this->render('offre/add.html.twig', [
            'addOffreForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/sim/offre/{id}/edit", name="edit_offre")
     */
    public function editAction(Request $request, Offre $offre){

        $form = $this->createForm(OffreFormType::class, $offre);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $offre = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            $this->addFlash('Success', 'Offre Updated !');

            return $this->redirectToRoute('offre_list');
        }

        return $this->render('offre/edit.html.twig', [
            'editOffreForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/sim/offre/list", name="offre_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('SimBundle:Offre')->findAll();

        return $this->render('offre/list.html.twig', [
            'offres' => $offre
        ]);
    }
}