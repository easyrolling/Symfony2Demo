<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_form")
     */
    public function loginAction(Request $request) 
    {
      $authUtils = $this->get('security.authentication_utils');
      
      $error = $authUtils->getLastAuthenticationError();

      $lastUsername = $authUtils->getLastUsername();

      return $this->render(
        'security/login.html.twig',
        array(
          'last_username' => $lastUsername,
          'error' => $error,
        )
      ); 
    }
    /**
     * @Route("/register", name="register")
     */
    public function registerAction()
    {
      $user = new User();
      $form = $this->createForm(new UserType(), $user, array('action' => $this->generateUrl('registeruser')));
      $form->add('submit', 'submit', array('label' => 'Register')); 
      return $this->render(
        'security/register.html.twig',
        array('form' => $form->createView())
      );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    
    }
    
    /**
     * @Route("/registeruser", name="registeruser")
     */
    public function registeruserAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity, array('action' => $this->generateUrl('registeruser')));
        $form->add('submit', 'submit', array('label' => 'Register'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($entity, $entity->getPassword());
            $entity->setPassword($encoded);

            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute("homepage");
        }

        return $this->render(
          'security/register.html.twig',
          array(
            'entity' => $entity,
            'form'   => $form->createView(),
          )
        );
    }
}
