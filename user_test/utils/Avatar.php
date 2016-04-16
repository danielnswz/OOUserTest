<?php

class Avatar{
		

		private $mimes;

		private $ruta;

		private $archivo;

		public function __construct(){
			 $this->mimes= array('image/jpeg','image/png');
			 $this->ruta = $_SERVER['DOCUMENT_ROOT']."/agentes_informaticos/resources/avatar/";
		}
		public function cargarAvatar($tipo,$tamanio,$archivotmp,$nombre_arch){

			
			$this->archivo = $this->ruta.$nombre_arch;

			if(in_array($tipo,$this->mimes) ){
				if(move_uploaded_file($archivotmp, $this->archivo) ){
					return $nombre_arch;
				}else{
					echo "No se pudo cargar el archivo al servidor";
				}
			}else{
				echo "Solo se admite .jpg o .png";
			}
		}

		public function borrarAvatar($nombre_arch){
			$this->archivo=$this->ruta.$nombre_arch;
			if(unlink($this->archivo)){
				return true;
			}else{
				return false;
			}
		}

}
		
		
?>