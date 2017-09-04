<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 9/3/2017
 * Time: 3:02 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Publisher;
use AppBundle\Form\AuthorType;
use AppBundle\Form\GenreType;
use AppBundle\Form\PublisherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AttributesController extends Controller
{

    /**
     * @Route("/attributes", name="add_attributes")
     *
     */
    public function addAttributesAction()
    {
        return $this->render('attributes.html.twig');
    }


    public function addAuthorAction()
    {
        $author = new Author();


        $form = $this->createForm(AuthorType::class, $author);

        return $this->render('author_add.html.twig', array('route'=>'/author', 'attributes'=>'Author',
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/author/new", name="new_author")
     *
     */
    public function newAuthorAction(Request $request)
    {
        $author = new Author();


        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        $author->setName($form->get('name')->getData());
        $author->setSurname($form->get('surname')->getData());

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user


        }

        return $this->redirect($this->generateUrl('add_attributes'));
    }

    public function addPublisherAction()
    {
        $publisher = new Publisher();


        $form = $this->createForm(PublisherType::class, $publisher);

        return $this->render('publisher_add.html.twig', array('route'=>'/publisher', 'attributes'=>'Publisher',
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/publisher/new", name="new_publisher")
     *
     */

    public function newPublisherAction(Request $request)
    {
        $publisher = new Publisher();


        $form = $this->createForm(PublisherType::class, $publisher);

        $form->handleRequest($request);

        $publisher->setPublisher($form->get('publisher')->getData());

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($publisher);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

        }

        return $this->redirect($this->generateUrl('add_attributes'));

    }


    public function addGenreAction()
    {
        $genre = new Genre();


        $form = $this->createForm(GenreType::class, $genre);

        return $this->render('genre_add.html.twig', array('route'=>'/genre', 'attributes'=>'Publisher',
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/genre/new", name="new_genre")
     *
     */

    public function newGenreAction(Request $request)
    {
        $genre= new Genre();

        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);

        $genre->setGenre($form->get('genre')->getData());
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user


        }

        return $this->redirect($this->generateUrl('add_attributes'));
    }
}