<?php
	if(isset($_POST['method']))
		$method=$_POST['method'];
	else
		$method=NULL;
	switch ($method) {
		case 'login':
			include("../utils/verificarDatos.php");

				$vd=new VerificarDatos($_POST['email'],md5($_POST['password']));
				
					$token=$_SESSION['token']=md5(uniqid(mt_rand(),true));
					if(isset($_POST['remember']) && $_POST['remember']==='on'){
						$vd->Acceso($token);
					}else{
						$vd->Acceso();
					}
				
					
			
				
				
			break;
		case 'update_usuario':
			//var_dump($_FILES);
			include("../controllers/UsuarioController.php");
			if(isset($_FILES['foto']))
				$archivo=$_FILES['foto'];
			else
				$archivo=$_POST['b_foto'];
			
				$u = new Usuario($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['sexi'],$_POST['email'],md5($_POST['password']),$archivo);
				$ra=UsuarioController::updateRecord($u);
				if($ra){
					echo "<div class='alert alert-success alert-dismissable' role='alert'>Actualizo Exitosamente!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
				}else{
					echo "<div class='alert alert-danger alert-dismissable' role='alert'>No se pudo realizar la actualización de datos!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
				}
			
			
			break;

		case 'delete_usuario':
			include("../controllers/UsuarioController.php");
			$u = UsuarioController::getInstance("id='".$_POST['id']."'");
			$ra = UsuarioController::deleteRecord($u);
			if($ra){
				echo "<script>cargar('../views/Usuario.php');</script>";
				echo "<div class='alert alert-warning alert-dismissable' role='alert'>Usuario Borrado Exitosamente!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			}else{
				echo "<div class='alert alert-danger alert-dismissable' role='alert'>No se pudo borrar el Usuario!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			}
			break;

		case 'save_usuario':
			include("../controllers/UsuarioController.php");
			if(isset($_FILES['foto']))
				$archivo=$_FILES['foto'];
			else
				$archivo=NULL;
			$u = new Usuario(NULL,$_POST['nombre'],$_POST['apellido'],$_POST['sexi'],$_POST['email'],md5($_POST['password']),$archivo);
			$ra=UsuarioController::insertRecord($u);
			if($ra){
				echo "<div class='alert alert-success alert-dismissable' role='alert'>Inserto Exitosamente!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			}else{
				echo "<div class='alert alert-danger alert-dismissable' role='alert'>No se pudo crear el Usuario!<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
			}
			break;

		default:
			echo "Not Found 404";
			break;
	}
?>