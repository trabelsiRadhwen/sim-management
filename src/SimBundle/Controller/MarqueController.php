<?php

namespace SimBundle\Controller;

use SimBundle\Entity\Marque;
use SimBundle\Form\MarqueFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MarqueController extends Controller
{


    /**
     * @Route("/sim/marque/ajouter", name="new_marque")
     */
    public function ajouterAction(Request $request)
    {

        $form = $this->createForm(MarqueFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());die;
            $marque = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();

            $this->addFlash('Success', 'New marque added !');

            return $this->redirectToRoute('marque_list');
        }

        return $this->render('marque/add.html.twig', [
            'addMarqueForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/sim/marque/{id}/edit", name="edit_marque")
     */
    public function editAction(Request $request, Marque $marque){

        $form = $this->createForm(MarqueFormType::class, $marque);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $marque = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();

            $this->addFlash('Success', 'Offre Updated !');

            return $this->redirectToRoute('marque_list');
        }

        return $this->render('marque/edit.html.twig', [
            'editMarqueForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/sim/marque/list", name="marque_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository('SimBundle:Marque')->findAll();

        return $this->render('marque/list.html.twig', [
            'marques' => $marque
        ]);
    }


    /**
     * @Route("/sim/marque/delete/{id}}", name="marque_delete")
     */
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository('SimBundle:Marque')->find($id);

        $em->remove($marque);
        $em->flush();
        $this->addFlash('Success','Marque deleted !');

        return $this->redirectToRoute('marque_list');
    }
}
