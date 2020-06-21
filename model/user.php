<?php 

include("../class/conexion.php");
	class User extends Conexion{

		private $id;
		private $nombre;
		private $apellido;
		private $email;
		private $password;


		public function getNombre() {
			return $this->nombre;
		}
		public function setNombre(string $nombre){
			$this->nombre = $nombre;
		}
		public function getApellido(){
			return $this->apellido;
		}
		public function setApellido(string $apellido){
			$this->apellido = $apellido;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail(string $email){
			$this->email = $email;
		}
		public function getPassword(){
			return hash("sha256",$this->password);
		}
		public function setPassword(string $password){			
			$this->password = hash("sha256",$password);
		}
		public function loginUser(){
			$conexion = new Conexion();
			$conex = $conexion->getConexion();
			$consulta = "SELECT email,password, nombre, apellido FROM users WHERE email = '".$this->getEmail()."' AND password = '".$this->getPassword()."'";
			$result = $conex->query("$consulta")->fetch(PDO::FETCH_ASSOC);
			$return = ($result['email'] != "") ? $result : 0 ;
			return $return;
		}
		public function registerUser()
		{
			
			$conexion = new Conexion();
			$conex = $conexion->getConexion();
			$id = [];
			$id = $conex->query("SELECT UUID() uuid")->fetch();
			$consul = $conex->prepare("INSERT INTO users (id, nombre, apellido, email,password,fecha_creacion) values (:id,:nombre,:apellido,:email,:password,now());");
			$consul->bindParam(':id',$id[0]);
			$consul->bindParam(':nombre',$this->getNombre());
			$consul->bindParam(':apellido',$this->getApellido());
			$consul->bindParam(':email',$this->getEmail());
			$consul->bindParam(':password',$this->getPassword());
			try {
				$consul->execute();
				return  1;

			} catch (PDOException $e) {
				
				return  0;
			}
		}
	}