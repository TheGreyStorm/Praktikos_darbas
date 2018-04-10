<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/5/2018
 * Time: 2:07 PM
 */

namespace AppBundle\Controller;


use AppBundle\Form\ChangeUserRoleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="admin")
     */

    public function adminAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('Admin/admin.html.twig', array('users' => $users));
    }


    /*/**
     * @Route("/admin/{id}/edit", name="edit_user_role")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    /*public function editRoleAction(Request $request)
    {
       // $request = $this->container->get('request_stack')->getCurrentRequest();

        $formEditUser = $this->createForm('AppBundle\Form\UserType');
        $formEditUser->handleRequest($request);

        if ($formEditUser->isValid()){
            $selectedUser = $request->request->get('value');
            $editUser = $this->getDoctrine()->getRepository('AppBundle:User')->find($selectedUser);
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->findUserByUsername($editUser->getUsername());
            $user->setRoles(array($selectedUser['role']));
            $userManager->updateUser($user);
        }

        return $this->render(
            'user/edit.html.twig',
            array(
                'editUserForm' => $formEditUser->createView()
            )
        );
    }*/
}