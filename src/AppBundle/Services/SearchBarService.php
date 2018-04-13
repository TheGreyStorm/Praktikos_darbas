<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/12/2018
 * Time: 4:36 PM
 */

namespace AppBundle\Services;


use Symfony\Component\Form\FormFactory;
use AppBundle\Form\SearchType;
use Symfony\Component\Routing\Router;

class SearchBarService
{
    private $router;
    private $formFactory;

    public function __construct(FormFactory $formFactory, Router $router)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    public function searchBar()
    {
        $form = $this->formFactory->createBuilder()
            ->setAction($this->router->generate('search_results'))
            ->add('search', SearchType::class)
            ->getForm();

        return $form->createView();
    }
}