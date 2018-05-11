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
     *
     * @Route("/admin/", name="admin")
     */
//Rodo visus registruotus userius pagal pasta su galimybe redaguoti paspaudus ant pasto
    public function adminAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('Admin/admin.html.twig', array('users' => $users));
    }

}