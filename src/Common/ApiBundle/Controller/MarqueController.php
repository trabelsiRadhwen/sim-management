<?php

namespace Common\ApiBundle\Controller;

use SimBundle\Entity\Marque;
use SimBundle\Form\MarqueFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MarqueController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("marques/")
     */
    public function getMarquesAction()
    {
        $marques = $this->getDoctrine()->getManager()->getRepository("SimBundle:Marque")->findAll();
        if (empty($marques)) {
            return new JsonResponse(['message' => 'Marque not found'], Response::HTTP_NOT_FOUND);
        }

        return $marques;
    }

    /**
     * @param $id
     * @Rest\View()
     * @Rest\Get("marques/{id}")
     */
    public function getMarqueAction($id)
    {
        $marque = $this->getDoctrine()->getManager()->getRepository("SimBundle:Marque")->find($id);
        if (empty($marque)) {
            return new JsonResponse(['message' => 'Marque not found'], Response::HTTP_NOT_FOUND);
        }

        return $marque;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/marques")
     * @throws \Doctrine\ORM\ORMException
     */
    public function postSimsAction(Request $request)
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueFormType::class, $marque);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($marque);
            $em->flush();
            return $marque;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/marques/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeSimAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $marque = $em->getRepository('SimBundle:Marque')
            ->find($request->get('id'));
        /* @var $marque Sim */

        if ($marque) {
            $em->remove($marque);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/marques/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateSimAction(Request $request)
    {
        $marque = $this->get('doctrine.orm.entity_manager')
            ->getRepository('SimBundle:Marque')
            ->find($request->get('id'));
        /* @var $marque Sim */

        if (empty($marque)) {
            return new JsonResponse(['message' => 'Marque not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(MarqueFormType::class, $marque);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($marque);
            $em->flush();
            return $marque;
        } else {
            return $form;
        }
    }
}
