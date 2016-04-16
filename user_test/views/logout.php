<?php
include("../utils/Cookie.php");
    session_start();
if(isset($_SESSION['email'])){
	Cookie::delete('hash');
    session_destroy();

 	

   header('Location: http://'.$_SERVER['HTTP_HOST'].'/agentes_informaticos/views/index.php');

   }else{
    echo "Error Not Found 404";
}

?>
