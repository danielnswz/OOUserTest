<?php
	include("../models/Usuario.php");
session_start();

if(isset($_SESSION['email'])){
	if(isset($_POST['ID_td'])){
		//MODIFICAR/ELIMINAR
		$u=new Usuario($_POST['ID_td'],$_POST['NOMBRE_td'],$_POST['APELLIDO_td'],$_POST['SEXO_td'],$_POST['EMAIL_td'],NULL,$_POST['foto']);

		$id= $u->getId();
		$nombre= $u->getNombre();
		$apellido= $u->getApellido();
		$sexo= $u->getSexo();
		$email= $u->getEmail();
		$foto = $u->getFoto();
	}else{
		$id="";
		$nombre= "";
		$apellido= "";
		$sexo= "";
		$email= "";
		$foto="";
	}
	echo "<script src='http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/resources/js/upload.js'></script>";
		?>
		<div id="div_adic" name="div_adic" align="center"></div>
			<div  class="container">
				<div id='mensaje'></div>
				<form enctype="multipart/form-data" method='post' class='form-gen' id='euser'>
					<div class="row">
						<input type="hidden" name='id' value="<?echo $id?>">
						<div class='col-sm-1 col-md-1 col-lg-1'>
							<label>Nombre:</label>
						</div>
						<div class='col-sm-3 col-md-3 col-lg-3'>
							<input type='text' name='nombre' value='<?echo $nombre?>'>
							<div id="e_nombre"></div>
						</div>
					
						<div class='col-sm-1 col-md-1 col-lg-1'>
					 		<label>Apellido:</label>
					 	</div>
					 	<div class='col-sm-3 col-md-3 col-lg-3'>
					 		<input type='text' name='apellido' value='<?echo $apellido?>'>
					 		<div id="e_apellido"></div>
					 	</div>
					</div>
					<div class="row">
						<div class='col-sm-1 col-md-1 col-lg-1'>
					 		<label>Sexo:</label>
					 	</div>
					 	<div class='col-sm-3 col-md-3 col-lg-3'>
					 		<select id='sexi' name='sexi'>
					 			<option value='F'>Femenino</option>
					 			<option value='M'>Masculino</option>
					 		</select>
					 	</div>

					 	<div class='col-sm-1 col-md-1 col-lg-1'>
					 		<label>Email:</label>
					 	</div>
					 	<div class='col-sm-3 col-md-3 col-lg-3'>
					 		<?php 
					 			if($email!=''){
					 		?>
					 				<input type='email' name='email' value='<?echo $email ?>' readonly>
					 		<?php
					 			}else{
					 		?>
					 				<input type='email' name='email' value=''>
					 		<?}?>
					 		<div id="e_email"></div>
					 	</div>
					</div>
					<div class="row">
						<div class='col-sm-1 col-md-1 col-lg-1'>
					 		<label>Password:</label>
					 	</div>
					 	<div class='col-sm-3 col-md-3 col-lg-3'>
					 		<input type='password' name='password' value=''>
					 		<div id="e_password"></div>
					 	</div>

					 	<div class='col-sm-1 col-md-1 col-lg-1'>
					 		<label>Foto:</label>
					 	</div>
					 	<div class='col-sm-3 col-md-3 col-lg-3'>
					 	<?php
					 		echo "<input type='file' name='foto' id='foto' value=''>";
					 		if($foto!=""){
					 			echo "<img src='http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/resources/avatar/".$foto."' style='max-width:100px'>
					 				   <input type='hidden' name='b_foto' id='b_foto' value='".$foto."'>";
					 		}
					 	?>
					 		
					 	</div>
					</div>
					
					<?php
						if($id!=""){
							echo "<button class='btn btn-default' tyṕe='submit' id='actualizar'>Actualizar</button>";
							echo "<button class='btn btn-default' tyṕe='submit' id='delete'>Eliminar</button>";
						}else{
							echo "<button class='btn btn-default' tyṕe='submit' id='guardar'>Guardar</button>";
						}
						echo "<input type='hidden' name='method' id='method' value=''>"	
					?>	
				</form>
			</div>
		</div>
		<?php
	if(($sexo=='F')||($sexo=='M')){
		?><script>
			$(document).ready(function(){
				$("#sexi option[value='<?echo $sexo?>']").attr('selected','selected');

				if($("#actualizar")){
					$("#actualizar").click(function(evento){
						evento.preventDefault();
						$("#method").attr('value','update_usuario');
						//console.log($("#method").val());
						//var formulario = new FormData($('#euser'));
						//
						//if($("#foto").val()!=''){
						//	$("#foto").upload("../utils/routes.php", function(success){
			        	//		console.log("done");
			        	//	});
						//}else{
							var url='../utils/ajax.php';
							formulario=$("#euser").serialize();
							$.ajax({
								type:'post',
								url: url,
								data: formulario,
								success: function(data){
									$("#mensaje").html(data);
									if($("#mensaje").html()=='')
										if($("#foto").val()!=''){
											$("#foto").upload("../utils/routes.php", function(success){
								        		console.log("done");
								        	});
								        }else{
								        	cargar('../utils/routes.php','contenido',formulario);
								        }
								}
							});
							
							
						//}
						
					});
				}

				if($("#delete")){
					$("#delete").click(function(evento){
						evento.preventDefault();
						$("#method").attr('value','delete_usuario');
						console.log($("#method").val());
						formulario=$("#euser").serialize();
						cargar('../utils/routes.php','contenido',formulario);
					});
				}

			});
			  </script>
    <?php
	}else{
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				if($("#guardar")){
					$("#guardar").click(function(evento){
						evento.preventDefault();
						$("#method").attr('value','save_usuario');
						//console.log($("#method").val());
						//formulario=$("#euser").serialize();
						//cargar('../utils/routes.php','contenido',formulario);
						var url='../utils/ajax.php';
							formulario=$("#euser").serialize();
							$.ajax({
								type:'post',
								url: url,
								data: formulario,
								success: function(data){
									$("#mensaje").html(data);
									if($("#mensaje").html()=='')
										if($("#foto").val()!=''){
											$("#foto").upload("../utils/routes.php", function(success){
								        		console.log("done");
								        	});
								        }else{
								        	cargar('../utils/routes.php','contenido',formulario);
								        }
								}
							});
					});
				}
			});
		</script>
		<?php
	}
}else{
	echo "Error Not Found 404";
}
?>