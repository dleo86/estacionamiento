<?php

$error = array();

class Lugar{
    protected $total;
    protected $subtotal;
    protected $datos;
    protected $fecha_arr;
    public $sentencia;
    public $tamanho_paginas;
    public function __construct() {   
        //$conexion = new DB();
        require_once 'db.php';
        $this->lugar=array();
        $this->datos=array();
    }
    ////////////////////////////////////////////////////////////////////////////
    //INSERCIONES
    ////////////////////////////////////////////////////////////////////////////
    protected function InsertLugar($Lugar) {
        $conexion = new DB();
        $sql = "INSERT INTO lugar (idLugar, Lugar) VALUES (default, :Lugar)";
        $insertar = $conexion->conectar()->prepare($sql);

        $insertar->execute(array(":Lugar"=>$Lugar));
    }
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZACIONES
    ////////////////////////////////////////////////////////////////////////////
    public function UpdateLugar($idLugar, $Lugar) {
        $conexion = new DB();
        $sql = "UPDATE lugar SET Lugar = :Lugar WHERE idLugar = '$idLugar'";
        $actualizar = $conexion->conectar()->prepare($sql);
        $actualizar->execute(array(":Lugar"=>$Lugar));
    }
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONES
    ////////////////////////////////////////////////////////////////////////////
    public function SelectLugar($empezar_desde, $tamanho_paginas) {
        $conexion = new DB();
        $sql = "SELECT * FROM lugar ORDER BY idLugar DESC LIMIT $empezar_desde, $tamanho_paginas";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($filas=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   $this->total[]=$filas;                 
        } 
        return $this->total;
    }
    
    public function LugarSeleccionado($idLugar) {
        $conexion = new DB();
        $sql1 = "SELECT * FROM lugar WHERE idLugar = '$idLugar'";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        //$sentencia->bindParam(':idLugar',$idLugar);
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        return $fila;
    }
     //PAGINACION
    public function Paginacion(){
        $conexion = new DB();
        $sql = "SELECT * FROM lugar";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute(array());
        return $seleccionar->rowCount();
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteLugar($idLugar) {
        $conexion = new DB();
        //Eliminar domicilio
        $sql1 = "DELETE FROM lugar WHERE idLugar = '$idLugar'";
        $eliminar1 = $conexion->conectar()->prepare($sql1);
        $eliminar1->execute();
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSQUEDAS
    ////////////////////////////////////////////////////////////////////////////
    protected function SearchFecha($fecha) {
        $conexion = new DB();
        $sql = "SELECT * FROM caja WHERE fechaCaja LIKE '%$fecha%'";
         $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->fecha_arr[]=$objetoconsulta;
        }   
        return $this->fecha_arr;
    }
     ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarLugar($nom) {
        $conexion = new DB();
        $sql = "SELECT * FROM lugar";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if( trim($validar['Lugar']) == trim($nom)){
                       return false;
                   }
        } 
        return true;
    }
    
    public function ValidarLugarUpdate($idLug,$nom) {
        $conexion = new DB();
        $sql = "SELECT * FROM lugar WHERE idLugar != '$idLug'";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if( trim($validar['Lugar']) == trim($nom)){
                       return false;
                   }
        } 
        return true;
    }
    
    public function ValidarLugarDelete($estado) {
        $conexion = new DB();
        $sql = "SELECT * FROM lugar";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if( trim($validar['Estado']) == trim($estado)){
                       return false;
                   }
        } 
        return true;
    }
}

?>