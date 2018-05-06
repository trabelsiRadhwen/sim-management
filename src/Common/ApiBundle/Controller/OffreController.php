<?php

namespace Common\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use SimBundle\Entity\Offre;
use SimBundle\Form\OffreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 */
class OffreController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("offres/")
     */
    public function getOffresAction()
    {
        $offres = $this->getDoctrine()->getManager()->getRepository("SimBundle:Offre")->findAll();
        if (empty($offres)) {
            return new JsonResponse(['message' => 'Offre not found'], Response::HTTP_NOT_FOUND);
        }

        return $offres;
    }

    /**
     * @param $id
     * @Rest\View()
     * @Rest\Get("offres/{id}")
     */
    public function getOffreAction($id)
    {
        $offre = $this->getDoctrine()->getManager()->getRepository("SimBundle:Offre")->find($id);
        if (empty($offre)) {
            return new JsonResponse(['message' => 'Offre not found'], Response::HTTP_NOT_FOUND);
        }

        return $offre;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/agents")
     * @throws \Doctrine\ORM\ORMException
     */
    public function postOffresAction(Request $request)
    {
        $offre = new Offre();
        $form = $this->createForm(OffreFormType::class, $offre);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($offre);
            $em->flush();
            return $offre;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/offres/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeOffreAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $offre = $em->getRepository('SimBundle:Offre')
            ->find($request->get('id'));
        /* @var $offre Offre */

        if ($offre) {
            $em->remove($offre);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/offres/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateOffreAction(Request $request)
    {
        $offre = $this->get('doctrine.orm.entity_manager')
            ->getRepository('SimBundle:Offre')
            ->find($request->get('id'));
        /* @var $offre Offre */

        if (empty($offre)) {
            return new JsonResponse(['message' => 'Offre not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(OffreFormType::class, $offre);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($offre);
            $em->flush();
            return $offre;
        } else {
            return $form;
        }
    }

}
