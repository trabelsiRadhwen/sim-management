<?php

namespace Common\ApiBundle\Controller;

use SimBundle\Entity\Sim;
use SimBundle\Form\SimFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SimApiController
 * @package Sim\SimBundle\Controller
 */
class SimController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("sims/")
     */
    public function getSimsAction()
    {
        $sims = $this->getDoctrine()->getManager()->getRepository("SimBundle:Sim")->findAll();
        if (empty($sims)) {
            return new JsonResponse(['message' => 'Sim not found'], Response::HTTP_NOT_FOUND);
        }

        return $sims;
    }

    /**
     * @param $id
     * @Rest\View()
     * @Rest\Get("sims/{id}")
     */
    public function getSimAction($id)
    {
        $sim = $this->getDoctrine()->getManager()->getRepository("SimBundle:Sim")->find($id);
        if (empty($sim)) {
            return new JsonResponse(['message' => 'Sim not found'], Response::HTTP_NOT_FOUND);
        }

        return $sim;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/sims")
     * @throws \Doctrine\ORM\ORMException
     */
    public function postSimsAction(Request $request)
    {
        $sim = new Sim();
        $form = $this->createForm(SimFormType::class, $sim);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($sim);
            $em->flush();
            return $sim;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/sims/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeSimAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $sim = $em->getRepository('SimBundle:Sim')
            ->find($request->get('id'));
        /* @var $sim Sim */

        if ($sim) {
            $em->remove($sim);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/sims/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateSimAction(Request $request)
    {
        $sim = $this->get('doctrine.orm.entity_manager')
            ->getRepository('SimBundle:Sim')
            ->find($request->get('id'));
        /* @var $sim Sim */

        if (empty($sim)) {
            return new JsonResponse(['message' => 'Sim not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(SimFormType::class, $sim);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($sim);
            $em->flush();
            return $sim;
        } else {
            return $form;
        }
    }

}
