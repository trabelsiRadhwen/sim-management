<?php

namespace Common\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use SimBundle\Entity\AgentCommercial;
use SimBundle\Form\AgentComFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 */
class AgentComController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("agents/com/")
     */
    public function getAgentComsAction()
    {
        $agents = $this->getDoctrine()->getManager()->getRepository("SimBundle:AgentCommercial")->findAll();
        if (empty($agents)) {
            return new JsonResponse(['message' => 'AgentCom not found'], Response::HTTP_NOT_FOUND);
        }

        return $agents;
    }

    /**
     * @param $id
     * @Rest\View()
     * @Rest\Get("agents/com/{id}")
     */
    public function getAgentComAction($id)
    {
        $agent = $this->getDoctrine()->getManager()->getRepository("SimBundle:AgentCommercial")->find($id);
        if (empty($agent)) {
            return new JsonResponse(['message' => 'AgentCom not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/agents/com")
     * @throws \Doctrine\ORM\ORMException
     */
    public function postAgentComsAction(Request $request)
    {
        $agent = new AgentCommercial();
        $form = $this->createForm(AgentComFormType::class, $agent);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($agent);
            $em->flush();
            return $agent;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/agents/com/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeAgentComAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $agent = $em->getRepository('SimBundle:AgentCommercial')
            ->find($request->get('id'));
        /* @var $agent AgentCommercial */

        if ($agent) {
            $em->remove($agent);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/agents/com/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateAgentComAction(Request $request)
    {
        $agent = $this->get('doctrine.orm.entity_manager')
            ->getRepository('SimBundle:AgentCommercial')
            ->find($request->get('id'));
        /* @var $agent AgentCommercial */

        if (empty($agent)) {
            return new JsonResponse(['message' => 'AgentCom not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AgentComFormType::class, $agent);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($agent);
            $em->flush();
            return $agent;
        } else {
            return $form;
        }
    }

    /**
     * @param $id
     * @Rest\View()
     * @Rest\Get("agents/com/{username}/login")
     */
    public function findAgentComAction($username)
    {
        $agent = $this->getDoctrine()->getManager()->getRepository("SimBundle:AgentCommercial")->findOneBy(["username" => $username]);
        if (empty($agent)) {
            return new JsonResponse(['message' => 'AgentCom not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent;
    }

}
