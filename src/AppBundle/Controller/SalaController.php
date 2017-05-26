<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mensaje;
use AppBundle\Entity\Sala;
use UserControlBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SalaController extends Controller
{
    /**
     * @Route("/salasapp/{token}", name="salasapp")
     * @Method({"GET", "POST"})
     */
    public function getSalasAppAction($token)
    {
        header("access-control-allow-origin: *");
        $helpers = $this->get("app.helpers");

        if($helpers->authCheck($token)==true){
            $user = $helpers->authCheck($token,true);
            $em = $this->getDoctrine()->getEntityManager();

            $rooms = $em->getRepository('AppBundle:Sala')->findAll();

            $all=[];
            $messages = [];
            $users = [];

            foreach ($rooms as $room){
                $flag = false;

                foreach ($room->getUsers() as $us){
                    if($us->getId()==$user->sub){
                        $u = ["id" => $us->getId(),
                            "username" => $us->getUsername(),
                            "name" => $us->getName(),
                            "information" => $us->getInformation()
                        ];
                        array_push($users,$u);
                        $flag=true;
                    }

                }

                if($flag==true)
                {
                    foreach ($room->getMensajes() as $message) {
                        $m = ["id" => $message->getId(),
                            "user" => ["id" => $message->getUser()->getId(),
                                "username" => $message->getUser()->getUsername(),
                                "name" => $message->getUser()->getName(),
                                "information" => $message->getUser()->getInformation()
                            ],
                            "content" => $message->getContent(),
                            "date" => $message->getDate()
                        ];
                        array_push($messages,$m);
                    }

                    $aux=[
                        "id" => $room->getId(),
                        "title" => $room->getTitle() ,
                        "description" => $room->getDescription(),
                        "year" => $room->getYear(),
                        "author" => ["id" => $room->getAuthor()->getId(),
                            "username" => $room->getAuthor()->getUsername(),
                            "name" => $room->getAuthor()->getName(),
                            "information" => $room->getAuthor()->getInformation()
                        ],
                        "users" => $users,
                        "messages" => $messages,
                    ];
                    array_push($all,$aux);
                }
            }
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
