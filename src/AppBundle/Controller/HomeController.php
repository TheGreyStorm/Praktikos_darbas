<?php

namespace AppBundle\Controller;

use Genj\FaqBundle\Controller\FaqController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends BaseController{

    /**
     * @throws
     * @Route("/faq", name="home")
     */
    public function indexAction($categorySlug = null, $questionSlug = null)
    {
        if (!$categorySlug || !$questionSlug) {
            $redirect = $this->generateRedirectToDefaultSelection($categorySlug, $questionSlug);
            if ($redirect) {
                return $redirect;
            }
        }

        // Otherwise get the selected category and/or question as usual
        $questions        = array();
        $categories       = $this->getCategoryRepository()->retrieveActive();
        $selectedCategory = $this->getSelectedCategory($categorySlug);
        $selectedQuestion = $this->getSelectedQuestion($questionSlug);

        if ($selectedCategory) {
            $questions = $selectedCategory->getSortedQuestions();
        }

        // Throw 404 if there is no category in the database
        if (!$categories) {
            throw $this->createNotFoundException('You need at least 1 active faq category in the database');
        }
        return $this->render('Faq/index.html.twig',array(
            'categories'       => $categories = null,
            'questions'        => $questions = null,
            'selectedCategory' => $selectedCategory = null,
            'selectedQuestion' => $selectedQuestion = null
        ));
    }
}