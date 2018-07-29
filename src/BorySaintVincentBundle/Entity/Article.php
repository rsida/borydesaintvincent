<?php

namespace BorySaintVincentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="BorySaintVincentBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_text", type="string", length=255)
     */
    private $pictureText;

    /**
     * @var string|null
     *
     * @ORM\Column(name="short_description", type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="BorySaintVincentBundle\Entity\SchoolClass")
     * @ORM\JoinColumn(nullable=false)
     */
    private $schoolClass;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set picture.
     *
     * @param string $picture
     *
     * @return Article
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set pictureText.
     *
     * @param string $pictureText
     *
     * @return Article
     */
    public function setPictureText($pictureText)
    {
        $this->pictureText = $pictureText;

        return $this;
    }

    /**
     * Get pictureText.
     *
     * @return string
     */
    public function getPictureText()
    {
        return $this->pictureText;
    }

    /**
     * Set shortDescription.
     *
     * @param string|null $shortDescription
     *
     * @return Article
     */
    public function setShortDescription($shortDescription = null)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription.
     *
     * @return string|null
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set schoolClass.
     *
     * @param SchoolClass $schoolClass
     *
     * @return Article
     */
    public function setSchoolClass(SchoolClass $schoolClass)
    {
        $this->schoolClass = $schoolClass;

        return $this;
    }

    /**
     * Get schoolClass.
     *
     * @return string
     */
    public function getSchoolClass()
    {
        return $this->schoolClass;
    }
}
