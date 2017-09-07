<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Publisher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findAll();

        $featuredBooks = $em->getRepository(Book::class )->findBy(['featured' => 1]);

        $authors=$em->getRepository(Author::class )->findAll();
        $genres=$em->getRepository(Genre::class )->findAll();
        $publishers=$em->getRepository(Publisher::class )->findAll();

        return $this->render('homepage.html.twig',
            ['books' => $books,
                'featuredBooks' => $featuredBooks,
                'authors'=>$authors,
                'genres'=>$genres,
                'publishers'=>$publishers]);
    }

    /**
     *  @Route("/{id}", requirements={"id": "\d+"}, name="book_details")
     */
    public function bookDetailsAction(Book $book)
    {
        return $this->render('book_details.html.twig', ['books' => $book]);
    }

    /**
     *  @Route("/admin/{id}", requirements={"id": "\d+"}, name="admin_book_details")
     */
    public function adminBookDetailsAction(Book $book)
    {
        return $this->render('book_details_admin.html.twig', ['books' => $book]);
    }
}
