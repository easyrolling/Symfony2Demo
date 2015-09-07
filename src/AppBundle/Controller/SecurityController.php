<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_form")
     */
    public function loginAction(Request $request) 
    {
      $authUtils = $this->get('security.authentication_utils');
      
      $error = $authenticationUtils->getLastAuthenticationError();

      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render(
        'security/login.html.php',
        array(
          'last_username' => $lastUsername,
          'error' => $error,
        )
      ); 
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    
    }
}
