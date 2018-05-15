<?php
/**
 * Created by PhpStorm.
 * User: Radhwen
 * Date: 28/04/2018
 * Time: 00:22
 */

namespace SimBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SimBundle\Entity\Administrateur;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    /**
     * @param mixed $container
     */

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $admin = new Administrateur();
        $admin->setUsername('admin');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($admin,'admin_tt');
        $admin->setPassword($password);
        $manager->persist($admin);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}