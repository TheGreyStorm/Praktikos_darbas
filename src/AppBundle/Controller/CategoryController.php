<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 3/30/2018
 * Time: 4:11 PM
 */

namespace AppBundle\Controller;

use Genj\FaqBundle\Controller\CategoryController as BaseController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends BaseController
{
    /**
     * @Route("/faq/{slug}", name="Category")
     */
    public function showAction($slug)
    {

    }
}