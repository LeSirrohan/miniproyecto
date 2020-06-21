<?php 

	class Local{

		private $id;
		private $nombreLocal;


		public function getNombre() {
			return $this->nombreLocal;
		}

		public function setNombre(string $nombreLocal){
			$this->nombreLocal = $nombreLocal;
		}

	}