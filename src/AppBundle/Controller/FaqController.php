<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 3/30/2018
 * Time: 5:19 PM
 */

namespace AppBundle\Controller;

use Genj\FaqBundle\Controller\FaqController as BaseController;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends BaseController
{
    /**
     * @param string $categorySlug
     * @param string $questionSlug
     * @return \Symfony\Component\HttpFoundation\Response|void
     * @Route("")
     */
    public function indexAction($categorySlug, $questionSlug)
    {

    }
}