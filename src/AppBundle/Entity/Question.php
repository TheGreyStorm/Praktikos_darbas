<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="questions")
     * @ORM\OrderBy({"name" = "desc"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255, unique=true)
     */
    private $question;

    /**
     *
     * @Gedmo\Slug(fields={"question"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="text")
     */
    private $answer;


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
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

   /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Question
     */
   public function setSlug($slug)
    {
        $this->question = $slug;

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
     * Set body.
     *
     * @param string $answer
     *
     * @return Question
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     *
     * @return Question
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }
}
