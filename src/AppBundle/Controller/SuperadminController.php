<?php
/**
 * Created by PhpStorm.
 * User: josip
 * Date: 01-Sep-17
 * Time: 10:51
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Admin;
use AppBundle\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SuperadminController extends Controller
{
    /**
     * @Route("/superadmin/new", name="admin_add")
     */
    public function adminAdd(AuthenticationUtils $helper)
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);

        return $this->render(
            "security/admin_add.html.twig",
            ['error' => $helper->getLastAuthenticationError(), 'form' => $form->createView()  ]
        );
    }

    /**
     * @Route("/superadmin/new/add", name="admin_new")
     */
    public function newAdmin(Request $request, UserPasswordEncoderInterface $encoder){
        $admin = new Admin();

        $form = $this->createForm(AdminType::class, $admin);

        $form->handleRequest($request);

        $password = $form->get('password')->getData();


        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {
            return $this->render(
                'security/admin_add.html.twig',
                array('form' => $form->createView(), 'error' => 'Lozinka mora imati 8-30 znakova, slova i broj.',)
            );
        }

        $admin->setUsername($form->get('username')->getData());
        $admin->setRole("ROLE_ADMIN");

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $encoded = $encoder->encodePassword($admin, $password);
            $admin->setPassword($encoded);

            try {
                $em->persist($admin);
                $em->flush();
            } catch (\Exception $ex) {
                return $this->render(
                    'security/admin_add.html.twig',
                    array('form' => $form->createView(), 'error' => 'Admin sa zadanim korisničkim imenom postoji.',)
                );
            }
            return $this->redirect($this->generateUrl('admin_add'));
        }

        return $this->render(
            'security/admin_add.html.twig',
            array('form' => $form->createView(), 'error' => 'Lozinke nisu odgovarajuće',)
        );
    }
}