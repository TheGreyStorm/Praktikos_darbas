<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/3/2018
 * Time: 2:30 PM
 */

namespace AppBundle\Controller;

use Genj\FaqBundle\Controller\CategoryController as BaseController;

class CategoryController extends BaseController
{
    /**
     * shows questions within 1 category
     *
     * @param string $slug
     * @throws
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($slug)
{
    $category = $this->getCategoryRepository()->retrieveBySlug($slug);

    if (!$category) {
        throw $this->createNotFoundException('category doesnt exist');
    }

    return $this->render(
        ':Category:show.html.twig',
        array(
            'category' => $category
        )
    );
}

    /**
     * @return \AppBundle\Repository\CategoryRepository
     */
    protected function getCategoryRepository()
{
    return $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Category');
}
}