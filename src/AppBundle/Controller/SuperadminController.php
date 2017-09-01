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
     * @Route("/superadmin", name="admin_add")
     */
    public function adminAdd(AuthenticationUtils $helper)
    {
//        $this->denyAccessUnlessGranted('ROLE_SUPERADMIN', null, 'Unable to access this page!');

        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);

        return $this->render(
            "security/admin_add.html.twig",
            ['error' => $helper->getLastAuthenticationError(), 'form' => $form->createView()  ]
        );
    }

    /**
     * @Route("/superadmin/new", name="admin_new")
     */
    public function newAdmin(Request $request,UserPasswordEncoderInterface $encoder){
        $admin = new Admin();

        $form = $this->createForm(AdminType::class, $admin);

        $form->handleRequest($request);

        $password = $form->get('password')->getData();

        $admin->setUsername($form->get('username')->getData());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $encoded = $encoder->encodePassword($admin, $password);
            $admin->setPassword($encoded);

            $em->persist($admin);
            $em->flush();

            return $this->render(
                "admin_add.html.twig"
            );
        }

        return $this->redirect($this->generateUrl(
            'admin_add'
        ));
    }
}