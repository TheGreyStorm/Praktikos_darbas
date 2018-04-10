<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/9/2018
 * Time: 5:13 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findById()
    {
        $query = $this->findOneBy(array('id'));

        return $query;
    }
}