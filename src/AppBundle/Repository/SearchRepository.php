<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/12/2018
 * Time: 1:14 PM
 */

namespace AppBundle\Repository;


use FOS\ElasticaBundle\Repository;
use AppBundle\Entity\Search;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use Elastica\Query;

class SearchRepository extends Repository
{



    public function search(Search $search)
    {

        $query = new BoolQuery();

        if ($search->getAnswer() !=null && $search->getAnswer() != ''){
            $query->addMust(new Terms('answer', [$search->getAnswer()]));
        }
        if ($search->getCategory() !=null && $search->getCategory() != ''){
            $query->addMust(new Terms('category', [$search->getCategory()]));
        }
        if ($search->getQuestion() != null && $search->getQuestion() != ''){
            $query->addMust(new Terms('question', [$search->getQuestion()]));
        }
        if ($search->getSlug() !=null && $search->getSlug() != ''){
            $query->addMust(new Terms('slug', [$search->getSlug()]));
        }

        $query = Query::create($query);

        $this->find($query);
    }
}