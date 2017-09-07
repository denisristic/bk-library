<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

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
     * @var \Doctrine\Common\Collections\Collection|Author[]
     *
     * @ORM\ManyToMany(targetEntity="Author")
     * @ORM\JoinTable(
     *  name="book_author",
     *  joinColumns={
     *      @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     *  })
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
     * @var string
     *
     * @ORM\Column(type="string")
     *
     */
    private $image;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Book constructor.
     * @internal param $description
     * @internal param bool $featured
     */
    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->description = "-";
        $this->featured = 0;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set publicationDate
     *
     * @param integer $publicationDate
     *
     * @return Book
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return integer
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set pages
     *
     * @param integer $pages
     *
     * @return Book
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return integer
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set actionPrice
     *
     * @param integer $actionPrice
     *
     * @return Book
     */
    public function setActionPrice($actionPrice)
    {
        $this->actionPrice = $actionPrice;

        return $this;
    }

    /**
     * Get actionPrice
     *
     * @return integer
     */
    public function getActionPrice()
    {
        return $this->actionPrice;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Book
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\Author $author
     *
     * @return Book
     */
    public function addAuthor(\AppBundle\Entity\Author $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \AppBundle\Entity\Author $author
     */
    public function removeAuthor(\AppBundle\Entity\Author $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set publisher
     *
     * @param \AppBundle\Entity\Publisher $publisher
     *
     * @return Book
     */
    public function setPublisher(\AppBundle\Entity\Publisher $publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \AppBundle\Entity\Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set genre
     *
     * @param \AppBundle\Entity\Genre $genre
     *
     * @return Book
     */
    public function setGenre(\AppBundle\Entity\Genre $genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \AppBundle\Entity\Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    public function getAbsolutePath()
    {
        return null === $this->image
            ? null
            : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image
            ? null
            : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();

    }

    protected function getUploadDir()
    {
        return 'uploads/images';
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        $this->image = $this->getFile()->getClientOriginalName();

        $this->file = null;
    }
}
