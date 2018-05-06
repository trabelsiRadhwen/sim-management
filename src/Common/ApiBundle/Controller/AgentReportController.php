<?php

namespace Common\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use SimBundle\Entity\AgentReporting;
use SimBundle\Form\AgentReportFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 */
class AgentReportController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("agents/report/")
     */
    public function getAgentReportsAction()
    {
        $agents = $this->getDoctrine()->getManager()->getRepository("SimBundle:AgentReporting")->findAll();
        if (empty($agents)) {
            return new JsonResponse(['message' => 'AgentReport not found'], Response::HTTP_NOT_FOUND);
        }

        return $agents;
    }

    /**
     * @param $id
     * @Rest\View()
     * @Rest\Get("agents/report/{id}")
     */
    public function getAgentReportAction($id)
    {
        $agent = $this->getDoctrine()->getManager()->getRepository("SimBundle:AgentReporting")->find($id);
        if (empty($agent)) {
            return new JsonResponse(['message' => 'AgentReport not found'], Response::HTTP_NOT_FOUND);
        }

        return $agent;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/agents/report")
     * @throws \Doctrine\ORM\ORMException
     */
    public function postAgentReportsAction(Request $request)
    {
        $agent = new AgentReporting();
        $form = $this->createForm(AgentReportFormType::class, $agent);

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
     * @Rest\Delete("/agents/report/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function removeAgentReportAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $agent = $em->getRepository('SimBundle:AgentReporting')
            ->find($request->get('id'));
        /* @var $agent AgentReporting */

        if ($agent) {
            $em->remove($agent);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/agents/report/{id}")
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateAgentReportAction(Request $request)
    {
        $agent = $this->get('doctrine.orm.entity_manager')
            ->getRepository('SimBundle:AgentReporting')
            ->find($request->get('id'));
        /* @var $agent AgentReporting */

        if (empty($agent)) {
            return new JsonResponse(['message' => 'AgentReport not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AgentReportFormType::class, $agent);

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

}
