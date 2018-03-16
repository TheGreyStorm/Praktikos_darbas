<?php

namespace AppBundle\Controller;

use Genj\FaqBundle\Controller\FaqController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends BaseController{

    /**
     *
     * @Route("/faq", name="home")
     */
    public function indexAction($categorySlug = null, $questionSlug = null)
    {
        return $this->render('Faq/index.html.twig',array(
            'categories'       => $categories = null,
            'questions'        => $questions = null,
            'selectedCategory' => $selectedCategory = null,
            'selectedQuestion' => $selectedQuestion = null
        ));
    }
}