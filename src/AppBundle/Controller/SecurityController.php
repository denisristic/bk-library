<?php
/**
 * Created by PhpStorm.
 * User: josip
 * Date: 31-Aug-17
 * Time: 10:28
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controller for  logging into page as SuperAdmin or Admin role.
 *
 * Class SecurityController
 * @package AppBundle\Controller
 *
 */
class SecurityController extends Controller
{
    /**
     * Action for logging in, if user is not authenticated, it is redirected to this page.
     *
     * @Route("/login", name="security_login")
     */
    public function loginAction(AuthenticationUtils $helper)
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }

    /**
     * Action for logging out, defined in security.yml
     *
     * @Route("/logout",name="security_logout")
     */
    public function logoutAction()
    {
    }
}