<?php

namespace UserControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserControlBundle:Default:index.html.twig');
    }
    public function pruebasAction()
    {
        $helpers = $this->get("app.helpers");
        $pruebas = array("id"=>1, "nombre"=>"antonio");
        return $helpers->json($pruebas);
    }
    public function loginAppAction(Request $request)
    {
        header("access-control-allow-origin: *");
        $username="";$password="";$getHash=null;

        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth"); //para la autentificacion de usuarios por toquen

        $json = $request->get("json",null);
//        $this->ge
        if($json != null)
        {
            $params = json_decode($json);
            if(isset($params->username)) {$username = $params->username;}
            if(isset($params->password)) {$password = $params->password;}
            if(isset($params->getHash)) {$getHash = $params->getHash;}

            if($username != null && $password != null)
            {
                if($getHash == null || $getHash == "false"){
                    $signup = $jwt_auth->signup($username, $password);
                }else{
                    $signup = $jwt_auth->signup($username, $password, true);
                }
                //$signup = $jwt_auth->signup($username,$password);
                return new JsonResponse($signup);
            }
            else
            {
                return $helpers->json(array(
                    "status" => "error",
                    "data" => "Login not valid!!"
                ));
            }
        }
        else
        {
            return $helpers->json(array(
                "status" => "error",
                "data" => "Send json with post !!"
            ));
        }
    }
}
