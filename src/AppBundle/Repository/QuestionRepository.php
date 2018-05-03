<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Question;
use Doctrine\ORM\EntityRepository;
use Genj\FaqBundle\Entity\QuestionRepository as BaseRepository;

/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @package \Repository
 */
class QuestionRepository extends EntityRepository//BaseRepository
{
    /**
     * @param $categorySlug
     * @return Question
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function retrieveFirstByCategorySlug($categorySlug)
    {
        $query = $this->createQueryBuilder('q')
            ->join('q.categoryName','c')
            ->where('c.slug = :categorySlug')
            ->orderBy('q.question','ASC')
            ->setMaxResults(1)
            ->getQuery();

        $query->setParameter('categorySlug', $categorySlug);

        return $query->getOneOrNullResult();
    }
    public function retrieveByCategorySlug($categorySlug)
    {
        $query = $this->createQueryBuilder('q')
            ->join('q.categoryName','c')
            ->where('c.slug = :categorySlug')
            ->orderBy('q.question','ASC')
            ->getQuery();

        $query->setParameter('categorySlug', $categorySlug);

        return $query->getResult();
    }
}
