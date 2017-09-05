<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity()
 */
class Author {

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @var \Doctrine\Common\Collections\Collection|Book[]
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="authors")
     */
    private $books;

    /**
     * Author constructor.
     * @internal param $id
     * @internal param $name
     * @internal param $surname
     */
    public function __construct(){
        $this->books=new ArrayCollection();
    }



    /**
     * @return mixed
     */
    public function addBook(Book $book)
    {
        if ($this->books->contains($book)) {
            return;

        }
        $this->books->add($book);
        $book->addAuthor($this);
    }
    /**
     * @param Author $authors
     */
    public function removeBook (Book $book)
    {
        if (!$this->books->contains($book)) {
            return;
        }
        $this->books->removeElement($book);
        $book->removeAuthor($this);
    }


    /**
     * @return mixed
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setid($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }



}