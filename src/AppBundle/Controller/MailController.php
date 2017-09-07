<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 9/7/2017
 * Time: 10:20 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class MailController extends Controller
{
    /**
     * @Route("/mail", name="mail")
     */
    public function mailAction(Request $request)
    {
        $emailTo="knjizara.libra@gmail.com";
        $emailFrom=$request->request->get('email');
        $subject="Pitanje o knjizi";
        $body="From: ".$emailFrom."\n\n".$request->request->get('comment');

        $header="From: ".$emailFrom;

        mail($emailTo, $subject, $body, $header);

        return $this->redirect($this->generateUrl('homepage'));
    }

}