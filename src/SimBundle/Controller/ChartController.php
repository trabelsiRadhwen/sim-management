<?php

namespace SimBundle\Controller;

use function intval;
use SimBundle\Entity\Sim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ob\HighchartsBundle\Highcharts\Highchart;
use function var_dump;

class ChartController extends Controller
{

    /**
     * @Route("/charts", name="charts")
     */
    public function suivreAction()
    {
        $em = $this->getDoctrine()->getManager();


        // line chart

        $sellsHistory = array(
            array(
                "name" => "Total des ventes",
                "data" => array(683, 756, 543, 1208, 617, 990, 1001)
            ),
            array(
                "name" => "Ventes en France",
                "data" => array(467, 321, 56, 698, 134, 344, 452)
            ),

        );

        $dates = array(
            "21/06", "22/06", "23/06", "24/06", "25/06", "26/06", "27/06"
        );

        $br = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $br->chart->renderTo('linechart');
        $br->title->text('Vente du 21/06/2013 au 27/06/2013');

        $br->yAxis->title(array('text' => "Ventes (milliers d'unité)"));

        $br->xAxis->title(array('text' => "Date du jours"));
        $br->xAxis->categories($dates);

        $br->series($sellsHistory);

        //pie chart sim vendu par marque

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Les ventes des cartes par marque');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));

        $query = $em->getRepository('SimBundle:Sim')->findMarqueSim();
        $result = $query;
        var_dump($result);
        $data = array();
        foreach ($result as $values) {
            $a = array($values['smar'], intval($values['mar']));
            array_push($data, $a);
        }
        $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));

        return $this->render('index.html.twig', array(
            'chart' => $ob,
            'line' => $br
        ));
    }
}
