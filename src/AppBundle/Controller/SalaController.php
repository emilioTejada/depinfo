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
     * @Route("/salasapp/{token}", name="roomsapp")
     * @Method({"GET"})
     */
    public function getRoomsAppAction($token)
    {
        header("access-control-allow-origin: *");
        $helpers = $this->get("app.helpers");

        if($helpers->authCheck($token)==true) {
            $em = $this->getDoctrine()->getEntityManager();
            $all = [];
            $users = [];

            $user = $helpers->authCheck($token, true);
            $userFull = $em->getRepository('UserControlBundle:User')->find($user->sub);


            foreach ($userFull->getSalas() as $room)
            {
                foreach ($room->getUsers() as $us) {
                    $u = ["id" => $us->getId(),
                        "username" => $us->getUsername(),
                        "name" => $us->getName(),
                        "information" => $us->getInformation()
                    ];
                    array_push($users, $u);
                }

                $aux = [
                    "id" => $room->getId(),
                    "title" => $room->getTitle(),
                    "description" => $room->getDescription(),
                    "year" => $room->getYear(),
                    "author" => $room->getAuthor()->getName(),
                    "users" => $users
                ];
                array_push($all, $aux);

            }
            return new JsonResponse($all);
        }
        else{
            return $helpers->json(array(
                "status" => "500",
                "data" => "Error de autenticacion, token incorrecto"
            ));
        }
    }

    /**
     * @Route("/salasapp/{token}/{idRoom}", name="getmessagesapp")
     * @Method({"GET"})
     */

    public function getMessagesAppAction($token,$idRoom)
    {
        header("access-control-allow-origin: *");
        $helpers = $this->get("app.helpers");

        if($helpers->authCheck($token)==true) {

            $em = $this->getDoctrine()->getEntityManager();
            $messages = [];

            $room = $em->getRepository('AppBundle:Sala')->find($idRoom);

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
                array_push($messages, $m);
            }
            return new JsonResponse($messages);
        }
        else{
            return $helpers->json(array(
                "status" => "500",
                "data" => "Error de autenticacion, token incorrecto"
            ));
        }
    }
    /**
     * @Route("/messageapp", name="setmessagesapp")
     * @Method({"POST"})
     */
    public function sendMessageAppAction(Request $request)
    {
        header("access-control-allow-origin: *");
        $helpers = $this->get("app.helpers");

        $m= new Mensaje();

        $json = $request->get("json",null);

        if($json != null)
        {
            $params = json_decode($json);

            if($helpers->authCheck($params->token)==true) {
                $userToken = $helpers->authCheck($params->token, true);
                if($params->content != null && $params->idRoom)
                {
                    $em = $this->getDoctrine()->getEntityManager();
                    $user = $em->getRepository('UserControlBundle:User')->find($userToken->sub);
                    $room = $em->getRepository('AppBundle:Sala')->find($params->idRoom);

                    $m->setDate(new \DateTime('now'));
                    $m->setContent($params->content);
                    $m->setUser($user);
                    $m->setSala($room);

                    $em->persist($m);
                    $em->flush();

                    return $helpers->json(array(
                        "status" => "200",
                        "data" => "Mensaje enviado correctamente"
                    ));
                }
                else{
                    return $helpers->json(array(
                        "status" => "500",
                        "data" => "El mensaje no se envio correctamente"
                    ));
                }
            }
            else{
                return $helpers->json(array(
                    "status" => "500",
                    "data" => "Error de autenticacion, token incorrecto"
                ));
            }
        }
        else
        {
            return $helpers->json(array(
                "status" => "500",
                "data" => "No se enviaron datos"
            ));
        }
    }
}