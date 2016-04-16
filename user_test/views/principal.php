<?php
session_start();
if(isset($_SESSION['email'])){
	echo "Bienvenido ".$_SESSION['nombre']." ".$_SESSION['apellido']."!<br>";
	echo "<img src='http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/resources/avatar/".$_SESSION['foto']."' style='max-width:100px'>";
	echo "<br>Email: ".$_SESSION['email'];
}else{
	echo "Error Not Found 404";
}
?>