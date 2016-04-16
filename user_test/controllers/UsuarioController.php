<?php 

include("../models/Usuario.php");
include("../connection/Conexion.php");
include("../utils/Avatar.php");

class UsuarioController{

	public function __construct($db){
		Conexion::Conectar();
	}

	public function getInstance($where){
		$u=NULL;
		$sql="SELECT * FROM USUARIO";
		if ($where != NULL)
            $sql= $sql." WHERE ".$where;

       
        if ($fila = mysql_fetch_object(mysql_query($sql))) {

		    $u = new Usuario($fila->id, $fila->nombre, $fila->apellido, $fila->sexo, $fila->email, $fila->password, $fila->foto);
			
		}
		return $u;
	}
	public function getList($where=NULL){
		$lista=NULL;
		$sql="SELECT * FROM USUARIO";
		if ($where != NULL)
            $sql= $sql." WHERE ".$where;

        if($rs=mysql_query($sql)){
        	while ($fila = mysql_fetch_object($rs)) {
		    	$u = new Usuario($fila->id, $fila->nombre, $fila->apellido, $fila->sexo, $fila->email, $fila->password, $fila->foto);
		    	$lista[$fila->id]=$u;
			}
        }
        return $lista;
	}

	public function insertRecord($user){
		$file=$user->getFoto();
		if(isset($file['type'])){
			$tipo = $file['type']; 
			$tamanio = $file['size']; 
			$archivotmp = $file['tmp_name'];
			$nombre_arch = $file['name'];
			$extension = end(explode('.', $file["name"]));

			$av = new Avatar();
			$na=$av->cargarAvatar($tipo,$tamanio,$archivotmp,$user->getEmail().".".$extension);
			$user->setFoto($na);
		}
		
		$sql = "INSERT INTO USUARIO(nombre, apellido, sexo, email, password, foto) VALUES ('".$user->getNombre()."','".$user->getApellido()."','".$user->getSexo()."','".$user->getEmail()."','".$user->getPass()."','".$user->getFoto()."')";
		if(mysql_query($sql)){
			return true;
		}else{
			 return false;
		}
	}

	public function updateRecord($user){
		$file=$user->getFoto();
		if(isset($file['type'])){
			$tipo = $file['type']; 
			$tamanio = $file['size']; 
			$archivotmp = $file['tmp_name'];
			$nombre_arch = $file['name'];
			$extension = end(explode('.', $file["name"]));

			$av = new Avatar();

			$na=$av->cargarAvatar($tipo,$tamanio,$archivotmp,$user->getEmail().".".$extension);

			$user->setFoto($na);
		}
		
		$sql = "UPDATE USUARIO SET nombre='".$user->getNombre()."',apellido='".$user->getApellido()."',sexo='".$user->getSexo()."',email='".$user->getEmail()."',password='".$user->getPass()."',foto='".$user->getFoto()."' WHERE id='".$user->getId()."'";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteRecord($user){
		
		$file=$user->getFoto();
		if($file!=NULL){
			$av = new Avatar();
			$av->borrarAvatar($file);
		}
		$sql = "DELETE FROM USUARIO WHERE id='".$user->getId()."'";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	} 

}

?>