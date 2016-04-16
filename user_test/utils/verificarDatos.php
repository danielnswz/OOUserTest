<?php
include("../controllers/UsuarioController.php");
include("Cookie.php");

class VerificarDatos{
  private $_email;
  private $_password;

  public function __construct($email,$password){
    $this->_email=$email;
    $this->_password=$password;
  }
  public function Acceso($token=NULL){
    
    
    $where="email='".$this->_email."'";
    if($u=UsuarioController::getInstance($where)){
      //echo "<br>desde VerificarDatos ".$u->getPass()." ==? ".$this->_password;
      if($u->getPass()==$this->_password){
        session_start();
        $sql="DELETE FROM HASH WHERE user_id='".$u->getId()."'";
        if(mysql_query($sql)){
          $sql="INSERT INTO HASH (user_id, hash) VALUES ('".$u->getId()."','".$token."')";
          if(($token!=NULL) && mysql_query($sql)){
            Cookie::put('hash',$token,604800);
          }
        }
          $_SESSION['id']=$u->getId();
          $_SESSION['nombre']=$u->getNombre();
          $_SESSION['apellido']=$u->getApellido();
          $_SESSION['email']=$u->getEmail();
          $_SESSION['foto']=$u->getFoto();
        ?>
          <script type="text/javascript">
            cargar('../views/index.php','body');
          </script>
        <?php
      }else{
        echo "<script>alert('Contraseña Invalida');cargar('../views/index.php','body');</script>";
        return false;
      }
    }else{
      echo "<script>alert('Email Invalido');cargar('../views/index.php','body');</script>";
      return false;
    }
    return true;
  }
}
//cargar('../views/index.php','body');</script>
?>