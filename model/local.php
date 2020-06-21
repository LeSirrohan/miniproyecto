<?php 
include("../class/conexion.php");

	class Local extends Conexion{

		private $id;
		private $nombreLocal;


		public function getNombre() {
			return $this->nombreLocal;
		}

		public function setNombre(string $nombreLocal){
			$this->nombreLocal = $nombreLocal;
		}
		public function getLocales(){
			$conexion = new Conexion();
			$conex = $conexion->getConexion();
			$result = $conex->query("SELECT * FROM local ");
			$data = [];
			while($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}

	}