<?php

namespace SimBundle\Controller;

use function count;
use function intval;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     */
    public function IndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $allSims = $em->getRepository('SimBundle:Sim')->findAll();

        $allAgentsCom = $em->getRepository('SimBundle:AgentCommercial')->findAll();

        $allOffres = $em->getRepository('SimBundle:Offre')->findAll();

        $marque = $em->getRepository('SimBundle:Marque')->findMarque();

        $em = $this->getDoctrine()->getManager();


        // pieChart

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Les ventes des cartes par marque');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));

        $query = $em->getRepository('SimBundle:Sim')->findSalesMarque();
        $result = $query;
        //var_dump($result);
        $data = array();
        foreach ($result as $values) {
            $a = array($values['smar'], intval($values['mar']));
            array_push($data, $a);
        }
        $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));


        // line chart

        $sql = $em->getRepository('SimBundle:Sim')->findSalesPoste();
        $results = $sql;
        //var_dump($results);
        $postes = array();
        foreach ($results as $res) {
            $a = array($res['poste']);
            array_push($postes, $a);
        }

        $numbers = array();
        foreach ($results as $nb) {
            $p = array(intval($nb['nb']));
            array_push($numbers, $p);
        }

        $sellsHistory = array(
            array(
                "name" => "Total des ventes",
                "data" => $numbers
            )
        );

        $br = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $br->chart->renderTo('linechart');
        $br->title->text('Vente des cartes par region');

        $br->yAxis->title(array('text' => "Nombre des ventes"));

        $br->xAxis->title(array('text' => "Region"));
        $br->xAxis->categories($postes);

        $br->series($sellsHistory);

        return $this->render('base.html.twig', [
            'countSims' => count($allSims),
            'countAgentCom' => count($allAgentsCom),
            'countMarque' => count($marque),
            'countOffres' => count($allOffres),
            'chart' => $ob,
            'line' => $br
        ]);
    }
}