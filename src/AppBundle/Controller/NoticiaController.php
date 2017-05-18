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
    public function getNewsAppAction($token)
    {
        header("access-control-allow-origin: *");
        $helpers = $this->get("app.helpers");

        if($helpers->authCheck($token)==true){
            $em = $this->getDoctrine()->getEntityManager();

            $news = $em->getRepository('AppBundle:Noticia')->findAll();
            $categories = $em->getRepository('AppBundle:Categoria')->findAll();

            //es necesario desarmar el objeto para eliminar los ciclos provocados por las relaciones
            //one to many y many to one

            $cats=[];
            foreach ($categories as $cat){
                $aux=["id" => $cat->getId(),"name" => $cat->getName()];
                array_push($cats,$aux);
            }
            $ns=[];
            foreach ($news as $n){

                $categoria = $n->getCategoria();
                $user = $n->getUser();
                $aux=["id" => $n->getId(),
                      "name" => $n->getName() ,
                      "description" => $n->getDescription(),
                      "category" => ["id" => $categoria->getId(),"name" => $categoria->getName()],
                      "user" => $user->getName()];

                array_push($ns,$aux);
            }

            $all = [$ns,$cats];
            return new JsonResponse($all);
        }
        else{
            return $helpers->json(array(
                "status" => "500",
                "data" => "error de autenticacion, token incorrecto"
            ));
        }



    }
}
