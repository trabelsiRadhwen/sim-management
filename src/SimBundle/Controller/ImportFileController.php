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
        if (isset($_POST["Import"])) {

            $filename = $_FILES["file"]["tmp_name"];
            $lines = file($filename);
            $number = count($lines);
            $file = fopen($filename, "r");
            while (!feof($file)) {
                while (($ar = fgetcsv($file, 1000, ';')) !== FALSE) {
                    $num = count($ar);
                    //echo $num;
                    $row++;
                    for ($c = 0; $c < $num; $c++) {
                        $results[$num] = array(
                            'numeroSerie' => $ar[0],
                            'etat' => $ar[1],
                            'marque' => $ar[2],
                            'username' => $ar[3],
                            'password' => $ar[4],
                            'nom' => $ar[5],
                            'prenom' => $ar[6],
                            'email' => $ar[7],
                            'tel' => $ar[8],
                            'posteRegion' => $ar[9],
                            'numeroAppel' => $ar[10],
                        );
                    }
                    print_r($results);
                    // print the array
                    echo "<br>";
                }
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
