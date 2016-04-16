<?php

class Usuario
{
    PRIVATE $_id;
    PRIVATE $_nombre;
    PRIVATE $_apellido;
    PRIVATE $_sexo;
    PRIVATE $_email;
    PRIVATE $_password;
    PRIVATE $_foto;

    public function __construct($id, $nombre=NULL, $apellido=NULL, $sexo=NULL, $email, $password=NULL, $foto=NULL) {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_sexo = $sexo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_foto = $foto;
    }

    public function getId(){
        return $this->_id;
    }

    public function setId($id){
        $this->$_id = $id;
    }

    public function getNombre(){
        return $this->_nombre;
    }

    public function setNombre($nombre){
        $this->_nombre = $nombre;
    }

    public function getApellido(){
        return $this->_apellido;
    }

    public function setApellido($apellido){
        $this->_apellido = $apellido;
    }

    public function getSexo(){
        return $this->_sexo;
    }

    public function setSexo($sexo){
        $this->_sexo = $sexo;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function setEmail($email){
        $this->_email = $email;
    }

    public function getPass(){
        return $this->_password;
    }

    public function setPass($password){
        $this->_password = $password;
    }

    public function getFoto(){
        return $this->_foto;
    }

    public function setFoto($foto){
        $this->_foto = $foto;
    }

}

?>