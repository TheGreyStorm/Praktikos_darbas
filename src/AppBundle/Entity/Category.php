<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="category")
     */
    protected $questions;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->name = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
   public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get questions
     *
     * @return Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Get Sorted questions by Name
     *
     * @return Collection
     */
    public function getSortedQuestions()
    {
        $criteria = Criteria::create();
        $criteria->orderBy(array('name' => 'DESC'));

        return $this->getQuestions()->matching($criteria);
    }
    /**
     * Returns the route name for url generation
     *
     * @return string
     */
    public function getRouteName()
    {
        return 'question';
    }

    /**
     * Returns the route parameters for url generation
     *
     * @return array
     */
    public function getRouteParameters()
    {
        return array(
            'slug' => $this->getSlug()
        );
    }
}
