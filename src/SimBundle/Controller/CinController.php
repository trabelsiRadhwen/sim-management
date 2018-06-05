<?php

namespace SimBundle\Controller;

use function serialize;
use SimBundle\Entity\Cin;
use SimBundle\Form\CinFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class CinController extends Controller
{
    /**
     * @Route("/api/cin/{id}")
     */
    public function apiData($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Cin $cin */
        $cin = $em->getRepository('SimBundle:Cin')->findOneBy(["cin" => $id]);
        return new JsonResponse($this->convert($cin));
    }

    private function convert(Cin $cin)
    {
        return [
            "cin" => $cin->getCin(),
            "name" => $cin->getNom(),
            "prenom" => $cin->getPrenom(),
            "dob" => $cin->getDob(),
            "place" => $cin->getPlace()
        ];
    }

    /**
     * @Route("/cin/ajouter",name="new_cin")
     */
    public function ajouterAction(Request $request)
    {
        $form = $this->createForm(CinFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());die;
            $cin = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($cin);
            $em->flush();

            $this->addFlash('Success', 'New cin added !');

            return $this->redirectToRoute('cin_list');
        }

        return $this->render('cin/add.html.twig', [
            'addCinForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/cin/{id}/edit", name="cin_edit")
     */
    public function editAction(Request $request, Cin $cin)
    {

        $form = $this->createForm(CinFormType::class, $cin);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());die;
            $cin = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($cin);
            $em->flush();

            $this->addFlash('Success', 'Cin Updated !');

            return $this->redirectToRoute('cin_list');
        }

        return $this->render('cin/edit.html.twig', [
            'editCinForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/cin/list", name="cin_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cin = $em->getRepository('SimBundle:Cin')->findAll();

        return $this->render('cin/list.html.twig', [
            'cins' => $cin
        ]);
    }

    /**
     * @Route("/cin/delete/{id}}", name="cin_delete")
     */
    public function deleteSimAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cin = $em->getRepository('SimBundle:Cin')->find($id);

        $em->remove($cin);
        $em->flush();
        $this->addFlash('Success', 'Cin deleted !');

        return $this->redirectToRoute('cin_list');
    }
}
