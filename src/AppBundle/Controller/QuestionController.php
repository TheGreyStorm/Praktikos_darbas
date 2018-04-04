<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/3/2018
 * Time: 4:27 PM
 */

namespace AppBundle\Controller;


use AppBundle\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends Controller
{
    /**
     * shows question if active
     * @Route("/faq/{categorySlug}/{slug}", name="question")
     * @param string $slug
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($slug)
    {
        //$securityContext = $this->container->get('security.authorization_checker');
        $question        = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Question')->find($slug);

       /* if (!$question || (!$question->isPublic() && !$securityContext->isGranted('ROLE_EDITOR'))) {
            throw $this->createNotFoundException('question not found');
        }*/

        return $this->render(
            ':Question:show.html.twig',
            array(
                'question' => $question
            )
        );
    }


    /**
     * list questions which fitting the query
     *
     * @param string $query
     * @param int    $max
     * @param array  $whereFields
     * @throws
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listByQueryAction($query, $max = 30, $whereFields = array('headline', 'body'))
    {
        $questions = $this->getQuestionRepository()->retrieveByQuery($query, $max, $whereFields);

        return $this->render(
            ':Question:list_by_query.html.twig',
            array(
                'questions' => $questions,
                'max'       => $max
            )
        );
    }

    /**
     * @param int       $id
     * @param \stdClass $object
     * @param string    $style
     * @param string    $source
     * @param string    $headline
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
 /*   public function teaserByIdOrObjectAction($id = null, $object = null, $style = null, $source = null, $headline = null)
    {
        $question = $object;

        if ($id !== null) {
            $question = $this->getQuestionRepository()->findOneById($id);
        }

        return $this->render(
            'GenjFaqBundle:Question:teaser_by_id_or_object.html.twig', array(
                'question' => $question,
                'style'    => $style,
                'source'   => $source,
                'headline' => $headline
            )
        );
    }*/

    /**
     * @return QuestionRepository
     */
    protected function getQuestionRepository()
    {
        return $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Question');
    }
}