<?php

$error = array();

class Usuario1{
    protected $idPersona;
    protected $usuario;
    protected $datos;
    protected $nomUsuario;
    protected $Localidad;
    public $sentencia;
    protected $user_arr;
    protected $apel_arr;
    ////////////////////////////////////////////////////////////////////////////
    //CONSTRUCTOR
    ////////////////////////////////////////////////////////////////////////////
    public function __construct() {   
        //$conexion = new DB();
        require_once 'db.php';
        $this->usuario=array();
        $this->datos=array();
    }
    ////////////////////////////////////////////////////////////////////////////
    //INSERCIONES
    ////////////////////////////////////////////////////////////////////////////
    protected function InsertDomicilio($calle, $numDom, $piso, $dpto) {
        $conexion = new DB();
        $sql = "INSERT INTO domicilio(idDomicilio, calleDom, numDom, pisoDom, dptoDom) VALUES (default,  :calleDom, :numDom, :pisoDom, :dptoDom)";
        $insertar = $conexion->conectar()->prepare($sql);
        $insertar->execute(array(":calleDom"=>$calle, ":numDom"=>$numDom,":pisoDom"=>$piso, ":dptoDom"=>$dpto));       
    }
    
    protected function InsertPersona($nomPers, $apelPers, $nacPers, $telPers, $dniPers) {
        $conexion = new DB();
        $sql = "INSERT INTO persona(idPersona, nomPersona, apelPersona, nacPersona, telPersona, dniPersona, Domicilio_idDomicilio) VALUES (default, :nomPersona, :ApelPersona, :nacPersona, :telPersona, :dniPersona, (SELECT MAX(idDomicilio) FROM domicilio))";
        $insertar = $conexion->conectar()->prepare($sql);
        $insertar->execute(array(":nomPersona"=>$nomPers, ":ApelPersona"=>$apelPers,":nacPersona"=>$nacPers, ":telPersona"=>$telPers, ":dniPersona"=>$dniPers ));
    }
    
    protected function InsertUser($nomUser,$passUser) {
        $conexion = new DB();
        $userPriv = "Usuario";
        $pass_cifrado= password_hash($passUser, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario ( idUsuario, userName, userPass, userPriv, userIngreso, Persona_idPersona) VALUES (default, :userName, :userPass, :userPriv, now(), (SELECT MAX(idPersona) FROM persona))";
        $insertar = $conexion->conectar()->prepare($sql);      
        $insertar->execute(array(":userName"=>$nomUser, ":userPass"=>$pass_cifrado,":userPriv"=>$userPriv));
    }
     ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZACIONES
    ////////////////////////////////////////////////////////////////////////////
     public function UpdateDomicilio($idDom, $calle, $numDom, $piso, $dpto) {
        $conexion = new DB();        
        $sql = "UPDATE domicilio "
                . "SET calleDom  = :calle, numDom = :numDom, pisoDom = :piso, dptoDom = :dpto WHERE idDomicilio = '$idDom'";
        $actualizar = $conexion->conectar()->prepare($sql);
        $actualizar->execute(array(":calle"=>$calle, ":numDom"=>$numDom, ":piso"=>$piso, ":dpto"=>$dpto));
    }   
    
    public function UpdatePersona($idPers,$nomPers, $apelPers, $nacPers, $telPers, $dniPers) {
        $conexion = new DB();
        $sql = "UPDATE persona "
                . "SET nomPersona  = :nomPers, apelPersona = :apelPers, nacPersona = :nacPers, telPersona = :telPers, dniPersona = :dniPers WHERE idPersona = '$idPers'";
        $actualizar2 = $conexion->conectar()->prepare($sql);
        $actualizar2->execute(array(":nomPers"=>$nomPers, ":apelPers"=>$apelPers, ":nacPers"=>$nacPers, ":telPers"=>$telPers, ":dniPers"=>$dniPers));
    }
    
    public function UpdateUser($idUser, $userName, $userPass) {
        $conexion = new DB();
        $pass_cifrado= password_hash($userPass, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario "
                . "SET userName  = :userName, userPass = :userPass WHERE idUsuario = '$idUser'";
        $actualizar3 = $conexion->conectar()->prepare($sql);
        $actualizar3->execute(array(":userName"=>$userName, ":userPass"=>$pass_cifrado));
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectUsuario($empezar_desde, $tamanho_paginas) {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario, persona, domicilio WHERE Persona_idPersona = idPersona AND Domicilio_idDomicilio = idDomicilio ORDER BY idUsuario DESC LIMIT $empezar_desde, $tamanho_paginas";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($filas=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   $this->usuario[]=$filas;
        } 
        return $this->usuario;
    }
    
    public function UserSeleccionado($userID1) {
        $conexion = new DB();
        $sql1 = "SELECT * FROM usuario, persona, domicilio "
                . "WHERE Persona_idPersona = idPersona AND idUsuario = '$userID1' AND Domicilio_idDomicilio = idDomicilio";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        return $fila;
    }
    //PAGINACION
    public function Paginacion(){
        $conexion = new DB();
        $sql = "SELECT * FROM usuario";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute(array());
        return $seleccionar->rowCount();
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarUsuario($userName) {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if((trim($validar['userName']) == trim($userName)) || (trim($userName) == NULL)){
                       return false;
                   }
        } 
        return true;
    }
    
    public function ValidarUsuario2($idUser,$username) {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario WHERE idUsuario != '$idUser'";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if(trim($validar['userName']) == trim($username)){
                       return false;
                   }
        } 
        return true;
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteUsuario($idUs, $idPers, $idDom) {
        $conexion = new DB(); 
        //Eliminar usuario
        $sql1 = "DELETE FROM usuario WHERE idUsuario = '$idUs'";
        $eliminar1 = $conexion->conectar()->prepare($sql1);
        $eliminar1->execute();
        //Eliminar persona
        $sql2 = "DELETE FROM persona WHERE idPersona = '$idPers'";
        $eliminar2 = $conexion->conectar()->prepare($sql2);
        $eliminar2->execute();
        //Eliminar domicilio
        $sql = "DELETE FROM domicilio WHERE idDomicilio = '$idDom'";
        $eliminar = $conexion->conectar()->prepare($sql);
        $eliminar->execute();
        
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSCAR
    ////////////////////////////////////////////////////////////////////////////
    protected function SearchUsuario($usuario) {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario, persona, domicilio WHERE Persona_idPersona = idPersona AND Domicilio_idDomicilio = idDomicilio AND userName LIKE '%$usuario%'";
        $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->user_arr[]=$objetoconsulta;
        }   
        return $this->user_arr;
    }
    protected function SearchApel($apellido) {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario, persona, domicilio WHERE Persona_idPersona = idPersona AND Domicilio_idDomicilio = idDomicilio AND apelPersona LIKE '%$apellido%'";
        $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->apel_arr[]=$objetoconsulta;
        }   
        return $this->apel_arr;        
    }
}

?>