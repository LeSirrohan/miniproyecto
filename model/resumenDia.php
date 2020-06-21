<?php 

include("../class/conexion.php");
	class resumenDia extends Conexion{

		private $idLocal;
		private $numeroDia;
		private $dia;
		private $monto;
		private $cantMesas;

		public function getIdLocal() {
			return $this->idLocal;
		}

		public function IdLocal(string $idLocal){
			$this->idLocal = $idLocal;
		}

		public function getNumeroDia(){
			return $this->numeroDia;
		}

		public function setNumeroDia(string $numeroDia){
			$this->numeroDia = $numeroDia;
		}

		public function getDia(){
			return $this->dia;
		}

		public function setDia(string $dia){
			$this->dia = $dia;
		}

		public function getMonto(){
			return $this->monto;
		}

		public function setMonto(string $monto){
			$this->monto = $monto;
		}
		public function getCantMesas(){
			return $this->cantMesas;
		}

		public function setCantMesas(string $cantMesas){
			$this->cantMesas = $cantMesas;
        }
        public function getResumenDia(int $idLocal){            
            $conexion = new Conexion();
            $conex = $conexion->getConexion();
            $consulta = "SELECT DATE_FORMAT(dia,'%d-%m-%Y') dia_venta,monto,cantMesas from resumendia";
            if($idLocal != ""){
                $consulta .= " WHERE idLocal = '{$idLocal}'";
            }
            $consulta.= "  ORDER BY dia asc ";
            $result = $conex->query("$consulta");

            $data = [];
            while($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
	}