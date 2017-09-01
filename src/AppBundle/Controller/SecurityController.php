<?php
/**
 * Created by PhpStorm.
 * User: josip
 * Date: 31-Aug-17
 * Time: 10:28
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Admin;
use AppBundle\Form\AdminType;
use AppBundle\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/admin", name="security_login")
     */
    public function loginAction(AuthenticationUtils $helper)
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }
    public function adminPage(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $admin= new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->get('username')->getData();
            $password = $form->get('password')->getData();

            $em = $this->getDoctrine()->getManager();
            $adminrepo= new AdminRepository($em, Admin::class);

            $encoded = $encoder->encodePassword($admin, $password);

            $enteredAdmin = $adminrepo->loadUserByUsername();

            if ($enteredAdmin->getPassword() == $encoded ) {
                return $this->redirectToRoute('admin_add');
            }

            return $this->redirectToRoute('task_success');
        }
        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));


    }
}