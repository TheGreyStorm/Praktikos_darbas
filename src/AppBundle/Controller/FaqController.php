<?php

namespace AppBundle\Controller;

use Genj\FaqBundle\Controller\FaqController as BaseController;
use Genj\FaqBundle\GenjFaqBundle;
use Symfony\Component\Routing\Annotation\Route;


class FaqController extends BaseController{

    /**
     * @Route("/")
     */
    public function show(){
        return $this->render('GenjFaqBundle/Faq/index.html.twig');
    }
}
