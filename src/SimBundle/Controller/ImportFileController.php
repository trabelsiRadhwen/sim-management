<?php

namespace SimBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use function count;
use function fclose;
use function feof;
use function fgetcsv;
use function fopen;
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

        if (isset($_POST["Import"])) {

            $filename = $_FILES["file"]["tmp_name"];
            //$lines = file($filename);
            //$number = count($lines);

            if (($handle = fopen($filename, "r")) !== FALSE) {

                while (!feof($handle)) {

                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);

                        $row = 1;
                        for ($c = 0; $c < $num; $c++) {

                            $results[$num] = array(
                                'numeroSerie' => $data[0],
                                'etat' => $data[1],
                                'marque' => $data[2],
                                'username' => $data[3],
                                'password' => $data[4],
                                'nom' => $data[5],
                                'prenom' => $data[6],
                                'email' => $data[7],
                                'tel' => $data[8],
                                'posteRegion' => $data[9],
                                'numeroAppel' => $data[10],
                            );
                            $row++;
                        }
                        print_r($results);
                    }
                }
                fclose($handle);
            }
        }

        foreach ($results as $row) {

            $em = $this->getDoctrine()->getManager();

            $numeroAppel = $em->getRepository(NumeroAppel::class)
                ->findOneBy([
                    'numeroAppel' => $row['numeroAppel']
                ]);

            if (null === $numeroAppel) {

                $numeroAppel = new NumeroAppel();
                $numeroAppel->setNumeroAppel($row['numeroAppel']);
                $em->persist($numeroAppel);
                $em->flush();
            }

            $marque = $em->getRepository(Marque::class)
                ->findOneBy([
                    'marque' => $row['marque']
                ]);

            if (null === $marque) {

                $marque = new Marque();
                $marque->setMarque($row['marque']);
                $marque->setNumeroAppel($numeroAppel);

                $em->persist($marque);
                $em->flush();
            }

            $agent = $em->getRepository(AgentCommercial::class)
                ->findOneBy([
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'email' => $row['email'],
                    'tel' => $row['tel'],
                    'posteRegion' => $row['posteRegion']
                ]);

            if (null === $agent) {

                $agent = new AgentCommercial();
                $agent->setUsername($row['username']);
                $agent->setPassword($row['password']);
                $agent->setNom($row['nom']);
                $agent->setPrenom($row['prenom']);
                $agent->setEmail($row['email']);
                $agent->setTel($row['tel']);
                $agent->setPosteRegion($row['posteRegion']);

                $em->persist($agent);
                $em->flush();
            }

            $sim = $em->getRepository(Sim::class)
                ->findOneBy([
                    'numeroSerie' => $row['numeroSerie'],
                    'etat' => $row['etat'],
                    'numeroAppel' => $row['numeroAppel'],
                    'marque' => $row['marque'],
                    'agent' => $row['agent'],
                ]);

            if (null === $sim) {

                $sim = new Sim();
                $sim->setNumeroSerie($row['numeroSerie']);
                $sim->setNumeroAppel($numeroAppel);
                $sim->setEtat($row['etat']);
                $sim->setMarque($marque);
                $sim->setAgent($agent);
                $numeroAppel->setMarque($marque);

                $em->persist($sim);

                $em->flush();
            }

            return $this->redirectToRoute('sim_list');
        }

        return $this->render('import/csv.html.twig');
    }
}
