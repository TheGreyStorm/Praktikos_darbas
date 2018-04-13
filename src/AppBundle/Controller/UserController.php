<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 *
 */
class UserController extends Controller
{

    /**
     * Creates a new user entity.
     *
     * @Route("/admin/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('Admin/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/admin/{id}", name="user_show")
     * @Method("GET")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        return $this->render('user/show.html.twig', array(
            'delete_form' => $deleteForm->createView(),
            'user' =>$user,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/admin/edit/{id}", name="user_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $formEditUser = $this->createForm(UserType::class, $user);
        $formEditUser->handleRequest($request);

        if ($formEditUser->isValid()){
            $selectedUser = $request->attributes->get('id');
            $editUser = $this->getDoctrine()->getRepository('AppBundle:User')->find($selectedUser);
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->findUserByUsername($editUser->getUsername());
            //$user->setRoles(array($selectedUser['roles']));
            $userManager->updateUser($user);
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
            'editUserForm' => $formEditUser->createView()
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/admin/{id}", name="user_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
