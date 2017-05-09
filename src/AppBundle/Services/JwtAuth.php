<?php
namespace AppBundle\Services;

use Firebase\JWT\JWT;

class JwtAuth {
	public $manager; //para acceder a las entidades por entity manager de doctrine
	public $key;
	
	public function __construct($manager) {
		$this->manager = $manager;
		$this->key = "clave-secreta";
	}
	
	public function signup($username, $password, $getHash = NULL){
		$key = $this->key;
		
		$user = $this->manager->getRepository('UserControlBundle:User')->findOneBy(
					array(
						"username" => $username,
						"password" => $password
					)
				);
		
		$signup = false;
		if(is_object($user)){
			$signup = true;
		}

		if($signup == true){
		    //este token nos servira para mandar todos los datos del usuario al cliente
            //con este toquen podremos verificar que el usuario es quien dice ser en cada acceso al servidor
            //el campo sub iat y exp son comunes en los tokens siendo iat el tiempo de creacion del token y exp la expiracion
            //en este caso el token expira en una semana
			$token = array(
				"sub" => $user->getId(),
				"email" => $user->getEmail(),
                "username" => $user->getUsername(),
				"name"	=> $user->getName(),
				"surname"	=> $user->getSurname(),
				"password"	=> $user->getPassword(),
                "information"	=> $user->getInformation(),
				"enable"	=> $user->getEnable(),
				"iat" => time(),
				"exp" => time() + (7 * 24 * 60 * 60)
			);
			//mediante estos metodos codificamos y decodificamos el token mediante hash
			$jwt = JWT::encode($token, $key, 'HS256');
			$decoded = JWT::decode($jwt, $key, array('HS256'));
			
			if($getHash != null){
				return $jwt;
			}else{
				return $decoded;
			}
            //return array("status" => "wuai", "data" => "bieen !!");
			
		}else{
			return array("status" => "error", "data" => "Fallo al logearse !!");
		}
	}

	//el identity sirve para comprobar si los datos vienen codificados o no
    //esta funcion sirve para comprobar si el token esta correcto
	public function checkToken($jwt, $getIdentity = false){
		$key = $this->key;
		$auth = false;
		
		try{
			$decoded = JWT::decode($jwt, $key, array('HS256'));
			
		}catch(\UnexpectedValueException $e){
			$auth = false;
		}catch(\DomainException $e){
			$auth = false;
		}
		
		if(isset($decoded->sub)){
			$auth = true;
		}else{
			$auth = false;
		}
		
		if($getIdentity == true){
			return $decoded;
		}else{
			return $auth;
		}
	}
	
}
