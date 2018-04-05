<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/5/2018
 * Time: 2:07 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}