<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserFormType;
use function ContainerNbSxonP\getSecurity_AuthorizationCheckerService;
use function ContainerNbSxonP\getSecurity_TokenStorageService;
use Couchbase\Authenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller {

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
    
    /**
     * @Route("/login/", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $session = $request->getSession();
        print_r($_POST);

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        /*
         * gal sits bet gal per pikts
         * https://symfony.com/doc/current/security/custom_authentication_provider.html
         *
         * KAIP PATIKRINT AR TEISINGAI JUNGIAS IR PRIJUNGT
         *
         * set token
         *
         * https://stackoverflow.com/questions/23347965/authentication-token-not-set-after-successful-login
         */

        return $this->render('Security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'request' => $session
        ));
    }

    /**
     * @Route("/login_check", name="login_check")
     */

    public function login_check()
    {
    }

    /**
     * @Route("/admin", name="admin")
     */
  /*  public function manageRoles()
    {
        $user = $this->getUser();
        $form = $this->createForm(EditUserFormType::class);

        $form->handleRequest($request);
            $user->setRoles($roles);
        return $this->render('admin.html.twig', array('form' => $form->createView()));
    }
*/
}