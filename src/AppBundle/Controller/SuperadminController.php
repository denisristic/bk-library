<?php
/**
 * Created by PhpStorm.
 * User: josip
 * Date: 01-Sep-17
 * Time: 10:51
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SuperadminController extends Controller
{
    /**
     * @Route("/superadmin", name="admin_add")
     */
    public function adminAdd(AuthenticationUtils $helper)
    {
//        $this->denyAccessUnlessGranted('ROLE_SUPERADMIN', null, 'Unable to access this page!');

        return $this->render(
            "security/admin_add.html.twig",
            ['error' => $helper->getLastAuthenticationError()]
        );
    }
}