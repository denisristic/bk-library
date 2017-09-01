<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookEntryController extends Controller
{
    /**
     * @Route("/new", name="new_book")
     *
     */
    public function newBookAction (){

        $form = $this->createForm(BookType::class, new Book());

        return $this->render('book_entry.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function submitBookAction(Request $request){
        $form = $this->createForm(BookType::class, new Book());

        //..... TODO

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            // perform some action...

            return $this->redirectToRoute('new_book');
        }

        return $this->render('book_entry.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}