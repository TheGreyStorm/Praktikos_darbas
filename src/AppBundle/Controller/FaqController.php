<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/3/2018
 * Time: 1:36 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Question;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\QuestionRepository;
use Genj\FaqBundle\Controller\FaqController as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends BaseController
{

   /* /**
     * @Route("/{slug}", defaults={"slug" = "category"})
     */

   /* public function listAction()
    {
        $categories = $this->getCategoryRepository()->retrieveAll();

        return $this->render(
            'Faq/index.html.twig',
            array(
                'categories' => $categories,
                'selectedCategory' => null
            )
        );
    }*/

    /**
     * @Route ("/")
     * @Route ("/category/", name="faq_index")
     *
     * Default index.
     * list all questions + answers show/hide can be defined in the template
     *
     * @param string $categorySlug
     * @param string $questionSlug
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundException
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function indexAction($categorySlug = null, $questionSlug = null)
    {
        /*if (!$categorySlug || !$questionSlug) {
            $redirect = $this->generateRedirectToDefaultSelection($categorySlug, $questionSlug);
            if ($redirect) {
                return $redirect;
            }
        }
            /* if (!$categorySlug){
                  $categories = $this->getCategoryRepository()->retrieveAll();
              } else if (!$questionSlug) {
                 $questions = $this->getSelectedCategory($categorySlug)->getQuestions();
             } else {*/
            // Otherwise get the selected category and/or question as usual
            $questions = array();
            $categories = $this->getCategoryRepository()->findAll();
            $selectedCategory = $this->getSelectedCategory($categorySlug);
            $selectedQuestion = $this->getSelectedQuestion($questionSlug);
            //}

            if ($selectedCategory) {
                $questions = $selectedCategory->getQuestions();
            }

            // Throw 404 if there is no category in the database
            if (!$categories) {
                throw $this->createNotFoundException('You need at least 1 active category in the database');
            }

            return $this->render(
                'Faq/index.html.twig',
                array(
                    'categories' => $categories,
                    'questions' => $questions,
                    'selectedCategory' => $selectedCategory,
                    'selectedQuestion' => $selectedQuestion
                )
            );
    }





    /**
     * Open first category or question if none was selected so far.
     *
     * @param string $categorySlug
     * @param string $questionSlug
     * @throws
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotHttpException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function generateRedirectToDefaultSelection($categorySlug, $questionSlug)
    {
        $doRedirect = false;
        $config     = $this->container->getParameter('genj_faq');

        if (!$categorySlug && $config['select_first_category_by_default']) {
            $firstCategory = $this->getCategoryRepository()->retrieveFirst();
            if ($firstCategory instanceof Category) {
                $categorySlug = $firstCategory->getSlug();
                $doRedirect   = true;
            } else {
                throw $this->createNotFoundException('Tried to open the first faq category by default, but there was none.');
            }
        }

        if (!$questionSlug && $config['select_first_question_by_default']) {
            $firstQuestion = $this->getQuestionRepository()->retrieveFirstByCategorySlug($categorySlug);
            if ($firstQuestion instanceof Question) {
                $questionSlug = $firstQuestion->getSlug();
                $doRedirect   = true;
            } else {
                throw $this->createNotFoundException('Tried to open the first faq question by default, but there was none.');
            }
        }

        if ($doRedirect) {
            return $this->redirect(
                $this->generateUrl('faq_index', array('categorySlug' => $categorySlug, 'questionSlug' => $questionSlug), true)
            );
        }

    }

    /**
     * @param string $questionSlug
     * @throws
     * @return Question|object
     */
    protected function getSelectedQuestion($questionSlug = null)
    {
        $selectedQuestion = null;

        if ($questionSlug !== null) {
            $selectedQuestion = $this->getQuestionRepository()->findOneBy(array('slug' => $questionSlug));
        }

        return $selectedQuestion;
    }

    /**
     * @param string $categorySlug
     *
     * @return Category|object
     */
    protected function getSelectedCategory($categorySlug = null)
    {
        $selectedCategory = null;

        if ($categorySlug !== null) {
            $selectedCategory = $this->getCategoryRepository()->findOneBy(array('slug' => $categorySlug));
        }

        return $selectedCategory;
    }

    /**
     * @return QuestionRepository
     */
    protected function getQuestionRepository()
    {
        return $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Question');
    }

    /**
     * @return CategoryRepository
     */
    protected function getCategoryRepository()
    {
        return $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Category');
    }
}