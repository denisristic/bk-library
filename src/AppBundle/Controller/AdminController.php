<?php
/**
 * Created by PhpStorm.
 * User: josip
 * Date: 07-Sep-17
 * Time: 12:54
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function adminPageAction()
    {
        return $this->render('security/admin_homepage.html.twig');
    }
}