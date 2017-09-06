<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Admin;
use AppBundle\Entity\SuperAdmin;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Created by PhpStorm.
 * User: josip
 * Date: 05-Sep-17
 * Time: 16:30
 */
class LoadSuperAdmin implements FixtureInterface, ContainerAwareInterface {
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $em)
    {
        $superAdmin = new Admin();

        $superAdmin->setUsername('pingu');
        $superAdmin->setRole('ROLE_SUPER_ADMIN');
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($superAdmin, 'nootnoot1');

        $superAdmin->setPassword($encoded);

        $em->persist($superAdmin);
        $em->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
