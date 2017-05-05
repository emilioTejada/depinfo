<?php

namespace UserControlBundle\Controller;

use UserControlBundle\Form\RegistroType;
use UserControlBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;


class UserController extends Controller
{
    public function loginAction(Request $request)
    {

        if(is_object($this->getUser())){
            return $this->redirect('home');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('UserControlBundle:User:login.html.twig',array(
            'last_username' => $lastUsername,
            'error' => $error
        ));

    }
    /*public function registerAction(Request $request)
    {
        $user= new User();
        //aqui irian los datos por defecto del usuario que se registra
        $form = $this->createForm(RegistroType::class, $user);

        if($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $user=$form->getData();
                $hash = password_hash($user->getPassword(), PASSWORD_BCRYPT, ['cost' => 12]);
                $user->setPassword($hash);
                $user->setFechaRegistro(new \DateTime("now"));

                $token=$this->genera_random(20);

                $user->setActivacion($token);

                $em=$this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $link="ruta de activacion de usuario/{$user->getId()}/{$token}";

                $cuerpo=$this->renderView('@UserControl/User/mailActivacion.html.twig',array('link' => $link,));

                $this->mandarCorreo('Confirmacion de registro','email de la app para registros',$user->getCorreo(),$cuerpo);

                return $this->render(
                    'UserControlBundle:User:login.html.twig',
                    array(
                        // last username entered by the user
                        'error'         => 'Se ha registrado con exito, le llegara un email con el link de activacion de la cuenta',
                        'last_username' => '',
                    )
                );
            }
        }
        return $this->render('UserControlBundle:User:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }*/






    /*function genera_random($longitud){
        $exp_reg="[^A-Z0-9]";
        //eregi_replace
        return substr(preg_replace($exp_reg, "", md5(rand())) .
            preg_replace($exp_reg, "", md5(rand())) .
            preg_replace($exp_reg, "", md5(rand())),
            0, $longitud);
    }
    public function mandarCorreo($asunto,$emisor,$receptor,$contenido)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($asunto)
            ->setFrom($emisor)
            ->setTo($receptor)
            ->setBody($contenido,'text/html');
        $this->get('mailer')->send($message);
    }*/
}