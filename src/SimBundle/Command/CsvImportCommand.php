<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 19/05/2018
 * Time: 00:38
 */

namespace SimBundle\Command;


use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use SimBundle\Entity\AgentCommercial;
use SimBundle\Entity\Marque;
use SimBundle\Entity\Offre;
use SimBundle\Entity\Sim;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImportCommand extends ContainerAwareCommand
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Import csv file');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);
        $io->title('Attemting to import the file');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/SimBundle/CsvFile/file.csv');

        $results = $reader->fetchAssoc();

        foreach ($results as $row){

            $marque = $this->em->getRepository(Marque::class)
                ->findOneBy([
                   'marque' => $row['marque']
                ]);

            if(null === $marque){

                $marque = new Marque();
                $marque->setMarque($row['marque']);

                $this->em->persist($marque);
                $this->em->flush();
            }

            $agent = $this->em->getRepository(AgentCommercial::class)
                ->findOneBy([
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'email' => $row['email'],
                    'tel' => $row['tel'],
                    'posteRegion' => $row['posteRegion']
                ]);

            if (null === $agent){

                $agent = new AgentCommercial();
                $agent->setUsername($row['username']);
                $agent->setPassword($row['password']);
                $agent->setNom($row['nom']);
                $agent->setPrenom($row['prenom']);
                $agent->setEmail($row['email']);
                $agent->setTel($row['tel']);
                $agent->setPosteRegion($row['posteRegion']);

                $this->em->persist($agent);
                $this->em->flush();
            }

            $sim = new Sim();
            $sim->setNumeroSerie($row['numeroSerie']);
            $sim->setNumeroAppel($row['numeroAppel']);
            $sim->setEtat($row['etat']);
            $sim->setMarque($marque);
            $sim->setAgent($agent);

            $this->em->persist($sim);
        }

        $this->em->flush();

        $io->success('Everything ok!');
    }
}