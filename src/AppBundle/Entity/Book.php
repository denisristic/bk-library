<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity()
 */
class Book {

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
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="books")
     * @ORM\JoinTable(name="authors_books")
     */
    private $authors;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $publicationDate;

    /**
     * @var Publisher
     * @ManyToOne(targetEntity="AppBundle\Entity\Publisher")
     * @JoinColumn(nullable=false)
     */
    private $publisher;

    /**
     * @var Genre
     * @ManyToOne(targetEntity="AppBundle\Entity\Genre")
     * @JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */

    private $pages;


    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $price;


    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $actionPrice;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2048, options={"default":false})
     */

    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":false})
     */

    private $featured;

    /**
     * Book constructor.
     * @param $description
     * @param bool $featured
     */
    public function __construct()
    {
        $this->description = "-";
        $this->featured = 0;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getActionPrice()
    {
        return $this->actionPrice;
    }

    /**
     * @param mixed $actionPrice
     */
    public function setActionPrice($actionPrice)
    {
        $this->actionPrice = $actionPrice;
    }

    /**
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }




}