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
            //'bar' => $br
        ));
    }
}
