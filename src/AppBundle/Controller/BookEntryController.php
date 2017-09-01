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
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        //... TODO shvatiti sto se okida i kako promijeniti



        if ($form->isSubmitted() && $form->isValid()) {

            $book->setTitle($form->get('title')->getData());
            $book->setAuthors($form->get('authors')->getData());
            $book->setGenre($form->get('genre')->getData());
            $book->setPublisher($form->get('publisher')->getData());
            $book->setPublicationDate($form->get('publication_date')->getData());
            $book->setPages($form->get('pages')->getData());
            $book->setPrice($form->get('price')->getData());
            $book->setActionPrice($form->get('action_price')->getData());

            $em = $this->getDoctrine()->getManager();

            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('new_book');
        }

        return $this->render('book_entry.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}