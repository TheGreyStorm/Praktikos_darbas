<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Question controller.
 */
class QuestionController extends Controller
{
    /**
     * Creates a new question entity.
     *
     * @Route("/newquestion", name="faq_new_question")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $question = new Question();
        $form = $this->createForm('AppBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('faq_show_question', array('questionSlug' => $question->getSlug(), 'categorySlug' => $question->getCategory()->getSlug()));
        }

        return $this->render('question/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     * @Route("category/{categorySlug}/{questionSlug}", name="faq_show_question")
     * @ParamConverter("question", class="AppBundle:Question", options={"mapping" : {"questionSlug" = "slug"}})
     * @Method("GET")
     */
    public function showAction(Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);

        return $this->render('question/show.html.twig', array(
            'question' => $question,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     * @Route("category/{categorySlug}/{questionSlug}/edit", name="faq_edit_question")
     * @ParamConverter("question", class="AppBundle:Question", options={"mapping" : {"questionSlug" = "slug"}})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $editForm = $this->createForm('AppBundle\Form\QuestionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faq_edit_question', array('questionSlug' => $question->getSlug(), 'categorySlug' => $question->getCategory()->getSlug()));
        }

        return $this->render('question/edit.html.twig', array(
            'categorySlug' => $question->getCategory()->getSlug(),
            'questionSlug' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a question entity.
     *
     * @Route("category/{categorySlug}/{questionSlug}", name="faq_delete_question")
     * @ParamConverter("question", class="AppBundle:Question", options={"mapping" : {"questionSlug" = "slug"}})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Question $question)
    {
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush();
        }

        return $this->redirectToRoute('faq_index');
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('faq_delete_question', array('questionSlug' => $question->getSlug(),  'categorySlug' => $question->getCategory()->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
