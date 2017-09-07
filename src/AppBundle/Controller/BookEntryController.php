<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Controller for entering and editing books.
 *
 * Class BookEntryController
 * @package AppBundle\Controller
 *
 */
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

    /**
     * @Route("admin/{id}/edit", name="edit_book", requirements={"id": "\d+"})
     */
    public function editBookAction(Book $book)
    {
        $form = $this->createForm(BookType::class, $book);

        return $this->render('book_edit.html.twig', array('route'=>'/admin/' . $book->getId() .'/edit', 'form' => $form->createView()));
    }

    /**
    * @Route("admin/{id}/edit/submit", name="submit_book", requirements={"id": "\d+"})
    */
    public function submitEditAction(Request $request, Book $book){

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        try {
            $this->validate($book);
        } catch (\Exception $ex) {
            $this->fail($request, $ex->getMessage());
            return $this->redirect($this->generateUrl('edit_book', ['id' => $book->getId()]));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if ($book->getFile() !== null) {
                $book->upload();
            }

            $em->persist($book);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Knjiga izmijenjena !')
            ;
        } else {
            $this->fail($request,"Nevaljana forma.");
        }

        return $this->redirect($this->generateUrl('admin_book_details', ['id' => $book->getId()]));
    }

    /**
     * Function for validating if book has correct attributes. Book has to be released
     * between age of 1455 and 2100, and it's action price should be lower than actual one.
     *
     * @param Book $book
     * @throws \Exception
     *
     */
    private function validate(Book $book) {
        if ($book->getPublicationDate() < 1455 ||$book->getPublicationDate() > 2100) {
            throw  new \Exception("Nevaljana godina.");
        }

        if ($book->getActionPrice() !== null && ($book->getPrice() < $book->getActionPrice())) {
            throw new \Exception("Akcijska cijena mora biti manja od početne.");
        }
    }

    /**
     * Method that sets fail message.
     *
     * @param Request $request
     * @param $message
     */
    private function fail(Request $request, $message) {
        $request->getSession()
            ->getFlashBag()
            ->add('fail', $message);
        ;
    }
}