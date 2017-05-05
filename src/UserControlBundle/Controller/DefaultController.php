<?php

namespace UserControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionUsuariosBundle:Default:index.html.twig');
    }
}
