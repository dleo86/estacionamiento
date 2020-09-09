<?php


$txtID1 = (isset($_POST['txtID1']))?$_POST['txtID1']:'';
$accion = (isset($_POST['accion']))?$_POST['accion']:'';
$error = array();

class Caja{
    protected $total;
    protected $subtotal;
    protected $datos;
    protected $fecha_arr;
    public $sentencia;
    public $tamanho_paginas;
    
    public function __construct() {   
        //$conexion = new DB();
        require_once 'db.php';
        $this->cliente=array();
        $this->datos=array();
    }
    ////////////////////////////////////////////////////////////////////////////
    //INSERCIONES
    ////////////////////////////////////////////////////////////////////////////
    protected function InsertCaja($totalCaja) {
        $conexion = new DB();
        $sql = "INSERT INTO caja (idCaja, totalCaja, fechaCaja) VALUES (default, :totalCaja, now())";
        $insertar = $conexion->conectar()->prepare($sql);

        $insertar->execute(array(":totalCaja"=>$totalCaja));
    }
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZACIONES
    ////////////////////////////////////////////////////////////////////////////
    public function UpdateCaja($idCaja, $totalCaja) {
        $conexion = new DB();
        $sql = "UPDATE caja SET totalCaja = :totalCaja WHERE idCaja = '$idCaja'";
        $actualizar = $conexion->conectar()->prepare($sql);

        $actualizar->execute(array(":totalCaja"=>$totalCaja));
    }
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONES
    ////////////////////////////////////////////////////////////////////////////
    public function SelectCaja($empezar_desde, $tamanho_paginas) {
        $conexion = new DB();
        $sql = "SELECT idCaja, totalCaja, SUM(Costo), fechaCaja FROM caja LEFT JOIN reserva ON idCaja = Caja_idCaja GROUP BY idCaja ORDER BY idCaja DESC LIMIT $empezar_desde, $tamanho_paginas";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($filas=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   $this->total[]=$filas;
                   $idCaja = $filas["idCaja"];
                   $totalCaja = $filas["SUM(Costo)"];
                   $this->UpdateCaja($idCaja, $totalCaja);
        } 
        return $this->total;
    }
    
    public function CajaSeleccionado($idCaja) {
        $conexion = new DB();
        $sql1 = "SELECT idCaja, totalCaja, fechaCaja FROM caja WHERE idCaja = :idCaja";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        $sentencia->bindParam(':idCaja',$idCaja);
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        return $fila;
    }
     //PAGINACION
    public function Paginacion(){
        $conexion = new DB();
        $sql = "SELECT * FROM caja";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute(array());
        return $seleccionar->rowCount();
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteCaja($idcaja) {
        $conexion = new DB();
        //Eliminar reserva
        $sql = "DELETE FROM reserva WHERE Caja_idCaja = '$idcaja'";
        $eliminar = $conexion->conectar()->prepare($sql);
        $eliminar->execute(); 
        //Eliminar caja
        $sql1 = "DELETE FROM caja WHERE idCaja = '$idcaja'";
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
}

?>