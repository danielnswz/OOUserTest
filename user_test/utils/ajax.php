<?php
	$mensaje = null;

	if(isset($_POST['id'])){
		$id=$_POST['id'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$sexo=$_POST['sexi'];
		$email=$_POST['email'];
		$password=$_POST['password'];

		if($password==''){
			$mensaje=$mensaje."<script>$('#e_password').html('El campo es requerido!');</script>";
		}else{
			if(strlen($password)<8){
				$mensaje=$mensaje."<script>$('#e_password').html('Debe tener minimo 8 caracteres de longitud!');</script>";
			}else{
				 if (!preg_match('`[a-z]`',$password)){
				 	$mensaje=$mensaje."<script>$('#e_password').html('Debe tener minimo una minuscula!');</script>";
				 }else{
				 	if(!preg_match('`[A-Z]`',$password)){
				 		$mensaje=$mensaje."<script>$('#e_password').html('Debe tener minimo una MAYUSCULA!');</script>";
				 	}else{
				 		if(!preg_match('`[0-9]`',$password)){
				 			$mensaje=$mensaje."<script>$('#e_password').html('Debe tener minimo un numero');</script>";
				 		}else{
				 			if(!preg_match('[\W]', $password)){
				 				$mensaje=$mensaje."<script>$('#e_password').html('Debe tener minimo un caracter especial');</script>";
				 			}else{
				 				$mensaje=$mensaje."<script>$('#mensaje').html('');</script>";
				 			}
				 		}
				 	}
				 }
			}
		} 
					

		if($nombre==''){
			$mensaje=$mensaje."<script>$('#e_nombre').html('El campo es requerido!');</script>";
		}
		if($apellido==''){
			$mensaje=$mensaje."<script>$('#e_apellido').html('El campo es requerido!');</script>";
		}
		if($email==''){
			$mensaje=$mensaje."<script>$('#e_email').html('El campo es requerido!');</script>";
		}
	}

	if(isset($_POST['method']) && $_POST['method']=='login'){
		$email=$_POST['email'];
		$password=$_POST['password'];
		if($password==''){
			$mensaje=$mensaje."<script>$('#e_password').html('El campo es requerido!');</script>";
		}else{
			$mensaje=$mensaje."<script>$('#e_password').html('');</script>";
		}
		if($email==''){
			$mensaje=$mensaje."<script>$('#e_email').html('El campo es requerido!');</script>";
		}else{
			$mensaje=$mensaje."<script>$('#e_email').html('');</script>";
		}
	}

	echo $mensaje;

?>