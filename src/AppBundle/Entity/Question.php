<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $imageName;
    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="imageName", size="imageSize")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="questions")
     * @ORM\OrderBy({"categoryName" = "desc"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $categoryName;

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
     * @param File|UploadedFile $imageName
     * @throws \Exception
     */
    public function setImageFile(?File $imageName = null): void
    {
        $this->imageFile = $imageName;

        if (null !== $imageName){
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
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
     * @Groups({"elastica"})
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
     * @Groups({"elastica"})
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
     * @Groups({"elastica"})
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @Groups({"elastica"})
     * @return Category
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param Category $categoryName
     *
     * @return Question
     */
    public function setCategoryName(Category $categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }
}
