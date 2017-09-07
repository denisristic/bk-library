<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Admin;
use AppBundle\Entity\SuperAdmin;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class for loading SuperAdmin
 *
 * Class LoadSuperAdmin
 * @package AppBundle\DataFixtures\ORM
 */
class LoadSuperAdmin implements FixtureInterface, ContainerAwareInterface {
    private $container;

    /**
     * Loading one initial SuperAdmin to database
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

    /**
     * Setting aware container for using dependency injection.
     *
     * @param ContainerInterface|null $container
     *
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
