<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookEntryController extends Controller
{
    /**
     * @Route("/book", name="add_book")
     *
     */
    public function newBookAction (){

        $form = $this->createForm(BookType::class, new Book());

        return $this->render('book_entry.html.twig', array('route'=>'/book',
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/book/new", name="new_book")
     *
     */
    public function submitBookAction(Request $request){
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        $book->setTitle($form->get('title')->getData());
        $book->setAuthors(array($form->get('authors')->getData()));
        $book->setGenre($form->get('genre')->getData());
        $book->setPublisher($form->get('publisher')->getData());
        $book->setPublicationDate($form->get('publication_date')->getData());
        $book->setPages($form->get('pages')->getData());
        $book->setPrice($form->get('price')->getData());
        $book->setActionPrice($form->get('action_price')->getData());
        $book->setDescription($form->get('description')->getData());

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($book);
            $em->flush();

            $this->addFlash('success', "Book added");

        }

        return $this->redirect($this->generateUrl('add_book'));

    }
}