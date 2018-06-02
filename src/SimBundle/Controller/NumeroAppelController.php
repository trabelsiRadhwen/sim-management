<?php

namespace SimBundle\Controller;

use SimBundle\Entity\NumeroAppel;
use SimBundle\Form\NumeroAppelTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class NumeroAppelController extends Controller
{

    /**
     * @Route("/sim/numero_appel/ajouter", name="new_numero_appel")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(NumeroAppelTypeForm::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $numeroAppel = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($numeroAppel);
            $em->flush();

            $this->addFlash('Success', 'New num added !');

            return $this->redirectToRoute('num_list');
        }

        return $this->render('numero/add.html.twig', [
            'addNumForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/sim/numero_appel/{id}/edit", name="edit_numero_appel")
     */
    public function editAction(Request $request, NumeroAppel $num){

        $form = $this->createForm(NumeroAppelTypeForm::class, $num);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());die;
            $num = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($num);
            $em->flush();

            $this->addFlash('Success', 'Sim Updated !');

            return $this->redirectToRoute('num_list');
        }

        return $this->render('numero/edit.html.twig', [
            'editNumForm' => $form->createView()
        ]);
    }

    /**
     * @Route("sim/numero_appel/list", name="num_list")
     */
    public function listeAction(){
        $em = $this->getDoctrine()->getManager();
        $num = $em->getRepository('SimBundle:NumeroAppel')->findAll();

        return $this->render('numero/list.html.twig', [
            'numeros' => $num,
        ]);
    }

    /**
     * @Route("/sim/numero_appel/delete/{id}}", name="num_delete")
     */
    public function deleteSimAction($id){
        $em = $this->getDoctrine()->getManager();
        $num = $em->getRepository('SimBundle:NumeroAppel')->find($id);

        $em->remove($num);
        $em->flush();
        $this->addFlash('Success','Sim Removed!');

        return $this->redirectToRoute('num_list');
    }
}