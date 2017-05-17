<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Noticia;

use AppBundle\Entity\Categoria;
use UserControlBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class NoticiaController extends Controller
{
    /**
     * @Route("/noticiasapp/{token}", name="noticiasapp")
     * @Method({"GET", "POST"})
     */
    public function getNoticiasAppAction($token)
    {
        header("access-control-allow-origin: *");
        $helpers = $this->get("app.helpers");

        if($helpers->authCheck($token)==true){
            $em = $this->getDoctrine()->getEntityManager();

            $noticias = $em->getRepository('AppBundle:Noticia')->findAll();

            $prueba=[];
            //es necesario desarmar el objeto para eliminar los ciclos provocados por las relaciones
            //one to many y many to one
            foreach ($noticias as $n){

                $categoria = $n->getCategoria();
                $user = $n->getUser();
                $aux=["id" => $n->getId(),
                      "name" => $n->getName() ,
                      "description" => $n->getDescription(),
                      "category" => ["id" => $categoria->getId(),"name" => $categoria->getName()],
                      "user" => $user->getName()];

                array_push($prueba,$aux);
            }
            return new JsonResponse($prueba);
        }
        else{
            return $helpers->json(array(
                "status" => "500",
                "data" => "error de autenticacion, token incorrecto"
            ));
        }



    }
}
