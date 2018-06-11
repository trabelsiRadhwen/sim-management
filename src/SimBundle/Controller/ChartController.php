<?php

namespace SimBundle\Controller;

use function count;
use function intval;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ChartController extends Controller
{

    /**
     * @Route("/charts",name="chart")
     */
    public function suivreAction()
    {
        $em = $this->getDoctrine()->getManager();

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


        //Bar chart
        $new = $em->getRepository('SimBundle:Sim')->findSalesAgentCom();
        $resNew = $new;
        //var_dump($resNew);
        $nom = array();
        foreach ($resNew as $vs) {
            $nm = array($vs['nom']);
            array_push($nom, $nm);
        }

        $nombre = array();
        foreach ($resNew as $nbrs) {
            $mbre = array(intval($nbrs['nbr']));
            array_push($nombre, $mbre);
        }

        $sales = array(
            array(
                "name" => "Totale des ventes",
                "data" => $nombre
            ),

        );

        $dates = array(
            $nom
        );


        $rt = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $rt->chart->renderTo('barchart');
        $rt->title->text('Vente des cartes SIM par agent commercial');
        $rt->chart->type('column');

        $rt->yAxis->title(array('text' => "Nombre totale"));

        $rt->xAxis->title(array('text' => "agent"));
        $rt->xAxis->categories($dates);

        $rt->series($sales);

        return $this->render('chart/chart.html.twig', [
            'chart' => $ob,
            'line' => $br,
            'bar' => $rt
        ]);
    }
}
