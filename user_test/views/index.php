<?php 

include("../controllers/UsuarioController.php");
include("../utils/Cookie.php");
session_start();
//$rs = UsuarioController::getInstance("email='danielnswz@gmail.com'");
//$rs = UsuarioController::getList();
/*foreach ($rs as $key => $value) {
	$u = $rs[$key];
	echo $u->getNombre();
}*/
//$u=$rs[1];
//$u->setEmail("holachi@hola.com");
//$u->setNombre("otronombreMAS1111");

/*echo $u->getId();
echo $u->getNombre();
echo $u->getApellido();
echo $u->getSexo();
echo $u->getEmail();
echo $u->getPass();
echo $u->getFoto();*/
/*$ra = UsuarioController::deleteRecord($u);

if($ra){
	echo "borro";
}else{
	echo "no inserto";
}*/
		echo   "<!DOCTYPE html>
                  <html lang='es'>
                  <head>
                  <meta name='viewport' content='width=device-width, initial-scale=1'>
                  <meta charset='UTF-8'>
                  <title>Agentes Informaticos</title>
                  </head>
                  <!-- Latest compiled and minified CSS -->
                  	<link rel='stylesheet' href='../resources/css/css.css'>
					<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

					<!-- Optional theme -->
					<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css' integrity='sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r' crossorigin='anonymous'>

					<!-- Latest compiled and minified JavaScript -->
					<script src='//code.jquery.com/jquery-1.12.0.min.js'></script>
					<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>
                  	
                  	<script src='http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/resources/js/cargar_panel.js'></script>
                  	
                  <body id='body'>";
if(Cookie::exists('hash') && !isset($_SESSION['email'])){
	$hash = Cookie::get('hash');
	$fila = Cookie::getInstance($hash);
	$where = "id='".$fila->user_id."'";
	$u=UsuarioController::getInstance($where);
	$_SESSION['id']=$u->getId();
    $_SESSION['nombre']=$u->getNombre();
    $_SESSION['apellido']=$u->getApellido();
    $_SESSION['email']=$u->getEmail();
    $_SESSION['foto']=$u->getFoto();
    echo "<script>cargar('index.php','body');</script>";
}else{
	if(!isset($_SESSION['email'])){
		
		echo 	"<div id='mensaje'></div><div id='dialog' align='center' title='Login' style='max-width:300px' class='container marketing form-signin'>
			        	<form id='login' method='post'>
			        	    <h2 class='form-signin-heading'>¡LOGUEATE!</h2>
			        	    <input type='email' name='email' id='email' class='form-control' placeholder='Username'>
			        	    <div id='e_email'></div>
			        	    <input type='password' name='password' id='password' class='form-control' placeholder='Password'>
			        	    <div id='e_password'></div>
			        	    <input type='hidden' name='method' value='login'>
			        	    <label for='remember'><input type='checkbox' name='remember'>Remember Me?</label><br>
			        		<button class='btn btn-large btn-primary' id='login_userbttn' type='submit'>Entrar</button>
			    		</form>
			      	</div>";
			     ?>
			    	<script type="text/javascript">
			    		$(document).ready(function(){
			    			if($("#login_userbttn")){
								$("#login_userbttn").click(function(evento){
									evento.preventDefault();
						    		var url='../utils/ajax.php';
									formulario=$("#login").serialize();
									$.ajax({
										type:'post',
										url: url,
										data: formulario,
										success: function(data){
											$("#mensaje").html(data);
											if(($("#e_password").html()=='')&&($("#e_email").html()==''))
										        	cargar('../utils/routes.php','body',formulario);
										        
										}
									});
								});
							}
			    		});
			    	</script>
			     <?php
}else{
			echo    "<div class='container marketing'>
		              	<div class='page-header'>
			                <div class='container'>
			                	<div class='col-sm-3 col-md-3 col-lg-3'>
				                    <div class='col-sm-12 col-md-12 col-lg-12' align=\"center\">
				                    	<img src='http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/resources/images/logo.png' class='img-responsive' width='150' > 
				                    </div>
			                  	</div>
			                  	<div align='center' class='col-sm-9 col-md-9 col-lg-9'>
			                    	<h1>Agentes Informaticos</h1>
			        	      	</div>
			                </div>
		              	</div>
		            </div>";
		    echo   "<div class='container marketing'>
			        	<div class='col-sm-3 col-md-3 col-lg-3'>
			        		<nav class='nav-side-menu'>
			                	<div class='accordion' id='leftMenu'>
			                  		<ul class='nav nav-pills nav-stacked'>
			                        	<li role='presentation' class='active'>
			                            	<a class='accordion-toggle' data-toggle='collapse' data-parent='#leftMenu' href='#' onclick='cargar(\"principal.php\",\"contenido\")'>
			                                	<span class='glyphicon glyphicon-home' aria-hidden='true'></span> Principal
			                            	</a>
			                        	</li>
			                        	<li role='presentation'>
				                            <a class='accordion-toggle' data-toggle='collapse' data-parent='#leftMenu' href='#' onclick='cargar(\"http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/views/Usuario.php\",\"contenido\")'>
				                                <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Registro de Usuarios
				                            </a>
				                        </li>
				                        <li role='presentation'>
				                            <a class='accordion-toggle' data-toggle='collapse' data-parent='#leftMenu' href='#' onclick='cargar(\"http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/views/listar.php\",\"contenido\")'>
				                                <span class='glyphicon glyphicon-search' aria-hidden='true'></span> Listar Usuarios
				                            </a>
				                        </li>
			                        	<li role='presentation'>
				                            <a href='http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/views/logout.php'>
				                                <span class='glyphicon glyphicon-off' aria-hidden='true'></span> Log Out
				                            </a>
				                        </li>
			                        </ul>
			                    </div>
			                </nav>
			            </div>
			            <div align='center' class='col-sm-9 col-md-9 col-lg-9' id='contenido' name='contenido'>
			            	<script>cargar('principal.php','contenido')</script>
			            </div>
			        </div>";
}

		echo 	  "</body>
				</html>";
	
}
			
			
?>
