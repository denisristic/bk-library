<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        try {
            $this->validate($book);
        } catch (\Exception $ex) {
            $this->fail($request, $ex->getMessage());
            return $this->redirect($this->generateUrl('add_book'));
        }


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $book->upload();
            $em->persist($book);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Knjiga dodana !')
            ;
        } else {
            $this->fail($request,"Nevaljana forma.");
        }

        return $this->render('book_entry.html.twig', array('route'=>'/book',
            'form' => $form->createView()
        ));
    }

    private function fail(Request $request, $message) {
        $request->getSession()
            ->getFlashBag()
            ->add('fail', $message);
        ;
    }

    private function validate(Book $book) {
        if ($book->getPublicationDate() < 1455 ||$book->getPublicationDate() > 2100) {
            throw  new \Exception("Nevaljana godina.");
        }

        if ($book->getActionPrice() !== null && ($book->getPrice() < $book->getActionPrice())) {
            throw new \Exception("Akcijska cijena mora biti manja od početne.");
        }
    }
}