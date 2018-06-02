<?php

namespace SimBundle\Controller;

use function count;
use Doctrine\ORM\EntityManagerInterface;
use function dump;
use function fclose;
use function feof;
use function fgetcsv;
use function fgets;
use function fopen;
use mysqli;
use function mysqli_fetch_assoc;
use const null;
use function print_r;
use SimBundle\Entity\AgentCommercial;
use SimBundle\Entity\Marque;
use SimBundle\Entity\NumeroAppel;
use SimBundle\Entity\Sim;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ImportFileController extends Controller
{

    /**
     * @Route("/import", name="import")
     */
    public function importAction()
    {

        $results = array();
        $row = 0;
        if (isset($_POST["Import"])){
            $filename = $_FILES["file"]["tmp_name"];
            /*$lines = file($filename);
            echo count($lines);*/

            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ";")) !== FALSE){
                $num = count($getData);
                for ($c = 0; $c <= $num ; $c++){

                        $results[$row] = array(
                            'numeroSerie' => $getData[0],
                            'numeroAppel' => $getData[1],
                            'etat' => $getData[2],
                            'marque' => $getData[3],
                            'username' => $getData[4],
                            'password' => $getData[5],
                            'nom' => $getData[6],
                            'prenom' => $getData[7],
                            'email' => $getData[8],
                            'tel' => $getData[9],
                            'posteRegion' => $getData[10]
                        );
                    $row++;
                }
                //print_r($results);
            }
            fclose($file);
        }
        /*$em = $this->getDoctrine()->getManager();

        foreach ($results as $result){

            $marque = new Marque();
            $marque->setMarque($result['marque']);

            $em->persist($marque);

            $numero = new NumeroAppel();
            $numero->setNumeroAppel($result['numeroAppel']);
            $numero->setMarque($marque);
            $em->persist($numero);

            $agent = new AgentCommercial();
            $agent->setUsername($result['username']);
            $agent->setPassword($result['password']);
            $agent->setNom($result['nom']);
            $agent->setPrenom($result['prenom']);
            $agent->setEmail($result['email']);
            $agent->setTel($result['tel']);
            $agent->setPosteRegion($result['posteRegion']);

            $em->persist($agent);

            $sim = new Sim();
            $sim->setNumeroSerie($result['numeroSerie']);

            $sim->setEtat($result['etat']);
            $sim->setMarque($marque);
            $sim->setAgent($agent);

            $em->persist($sim);

            $em->flush();

            return $this->redirectToRoute('sim_list');
        }*/
        return $this->render('import/csv.html.twig');
    }
}
