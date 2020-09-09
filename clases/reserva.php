<?php
$error = array();

class Reserva{
    protected $idPersona;
    protected $reserva;
    protected $datos;
    protected $nomCli;
    protected $Lugar;
    protected $Iva;
    public $sentencia;
    protected $cli_arr;
    protected $apel_arr;
    protected $caja_arr;
    protected $pat_arr;
    public $tamanho_paginas;
    ////////////////////////////////////////////////////////////////////////////
    //CONSTRUCTOR
    ////////////////////////////////////////////////////////////////////////////
    public function __construct() {   
        //$conexion = new DB();
        require_once 'db.php';
        //$this->$reserva=array();
        $this->datos=array();
    }
    ////////////////////////////////////////////////////////////////////////////
    //INSERCIONES
    ////////////////////////////////////////////////////////////////////////////
    protected function InsertVehiculo($patente) {
        $conexion = new DB();
        $sql = "INSERT INTO vehiculo (idVehiculo, patente) VALUES (default, :patente)";
        $insertar = $conexion->conectar()->prepare($sql);      
        $insertar->execute(array(":patente"=>$patente));
    }
    
    protected function InsertTurno($desde,$hasta,$costo,$idLugar,$idCaja,$Usuario,$idVehiculo) {
        $conexion = new DB();
        $sql = "INSERT INTO reserva (idReserva, Desde, Hasta, Costo, Lugar_idLugar, Caja_idCaja, Usuario_idUsuario, Vehiculo_idVehiculo) VALUES (default, now(), :Hasta, :Costo, :idLugar, (SELECT MAX(idCaja) FROM caja), (SELECT idUsuario FROM usuario WHERE userName = '$Usuario'),(SELECT MAX(idVehiculo) FROM vehiculo))";
        $insertar = $conexion->conectar()->prepare($sql);
        $insertar->execute(array( ":Hasta"=>$hasta,":Costo"=>$costo, ":idLugar"=>$idLugar));
    }
    
    protected function UpdateLugar($idLugar){
        $conexion = new DB();
        $estado = 'Ocupado';
        $sql = "UPDATE lugar SET Estado = :Estado WHERE idLugar = '$idLugar'";
        $actualizar1 = $conexion->conectar()->prepare($sql);
        $actualizar1->execute(array(":Estado"=>$estado));
    }
     ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZACIONES
    ////////////////////////////////////////////////////////////////////////////
     public function UpdateReserva($idVec, $patente) {
        $conexion = new DB();        
        $sql = "UPDATE vehiculo SET patente = :patente WHERE idVehiculo = '$idVec'";        
        $actualizar = $conexion->conectar()->prepare($sql);
        $actualizar->execute(array(":patente"=>$patente));
    }   
    
     public function UpdateCaja($idCaja,$totalCaja) {
        $conexion = new DB();        
        $sql = "UPDATE caja SET totalCaja = :totalCaja WHERE idCaja = '$idCaja'";        
        $actualizar = $conexion->conectar()->prepare($sql);
        $actualizar->execute(array(":totalCaja"=>$totalCaja));
    }   
    
    public function UpdatePersona($idPers,$nomPers, $apelPers, $nacPers, $telPers, $dniPers) {
        $conexion = new DB();
        $sql = "UPDATE persona "
                . "SET nomPersona  = :nomPers, apelPersona = :apelPers, nacPersona = :nacPers, telPersona = :telPers, dniPersona = :dniPers WHERE idPersona = '$idPers'";
        $actualizar2 = $conexion->conectar()->prepare($sql);
        $actualizar2->execute(array(":nomPers"=>$nomPers, ":apelPers"=>$apelPers, ":nacPers"=>$nacPers, ":telPers"=>$telPers, ":dniPers"=>$dniPers));
    }
    
    public function UpdateVehiculo($idVec,$patente, $marca, $modelo, $anio) {
        $conexion = new DB();
        $sql = "UPDATE vehiculo "
                . "SET patente  = :patente, marca = :marca, modelo = :modelo, anio = :anio WHERE idVehiculo = '$idVec'";
        $actualizar3 = $conexion->conectar()->prepare($sql);
        $actualizar3->execute(array(":patente"=>$patente, ":marca"=>$marca, ":modelo"=>$modelo, ":anio"=>$anio));
    }
    
    public function actualizarTurno($idTurno,$hasta) {
        $conexion = new DB();        
        $sql = "UPDATE reserva SET Hasta = now() WHERE idReserva = '$idTurno'";        
        $actualizar = $conexion->conectar()->prepare($sql);
        $actualizar->execute(array());
        //////////////////////////////////////////////////////////////////////////
        $sql1 = "SELECT * FROM reserva, caja, vehiculo, usuario, lugar "
                . "WHERE Caja_idCaja = idCaja AND idReserva = '$idTurno' AND Lugar_idLugar = idLugar AND Vehiculo_idVehiculo = idVehiculo AND Usuario_idUsuario = idUsuario";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        $costo = 0;
        $desde1 = new DateTime($fila['Desde']);
        $hasta1 = new DateTime($fila['Hasta']);
        $diff=date_diff($desde1,$hasta1);
        echo 'Diferencia: ' . $diff->format("%d days, %h hours and %i minuts");
        while($desde1 < $hasta1) {
            date_modify($desde1,"+30 minutes");
            $costo += 50;
        };
        $est = "No ocupado";
        ///////////////////////////////////////////////////////////////////////
        $sql = "UPDATE reserva SET Est = :Est, Costo = :Costo WHERE idReserva = '$idTurno'";        
        $actualizar = $conexion->conectar()->prepare($sql);
        $actualizar->execute(array(":Costo"=>$costo,":Est"=>$est));
    }
    protected function UpdateLugar2($idLugar){
        $conexion = new DB();
        $estado = "No ocupado";
        $sql = "UPDATE lugar SET Estado = :Estado WHERE idLugar = '$idLugar'";
        $actualizar1 = $conexion->conectar()->prepare($sql);
        $actualizar1->execute(array(":Estado"=>$estado));
    }
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectTurno($empezar_desde, $tamanho_paginas) {
        $conexion = new DB();
        $sql = "SELECT * FROM reserva, caja, vehiculo, usuario, lugar WHERE Caja_idCaja = idCaja AND Lugar_idLugar = idLugar AND Vehiculo_idVehiculo = idVehiculo AND Usuario_idUsuario = idUsuario ORDER BY Est Desc, idReserva DESC LIMIT $empezar_desde, $tamanho_paginas";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        $caja = 1;
        $total = 0;
        while($filas=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   $this->reserva[]=$filas;                 
        } 
        return $this->reserva;
    }
    
    public function TurnoSeleccionado($idTurno) {
        $conexion = new DB();
        $sql1 = "SELECT * FROM reserva, caja, vehiculo, usuario, lugar "
                . "WHERE Caja_idCaja = idCaja AND idReserva = '$idTurno' AND Lugar_idLugar = idLugar AND Vehiculo_idVehiculo = idVehiculo AND Usuario_idUsuario = idUsuario";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        return $fila;
    }
    
    public function SelectLugar(){
        $conexion = new DB();
        $sql1 = "SELECT * FROM lugar  WHERE Estado like 'No ocupado'";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        $sentencia->execute();
        while($filas=$sentencia->fetch(PDO::FETCH_ASSOC)){
                   $this->Lugar[]=$filas;
        } 
        return $this->Lugar;
    }
    
     public function SelectVehic(){
        $conexion = new DB();
        $sql2 = "SELECT * FROM vehiculo";
        $sentencia = $conexion->conectar()->prepare($sql2); 
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        return $fila;
     }
    //PAGINACION
    public function Paginacion(){
        $conexion = new DB();
        $sql = "SELECT * FROM reserva";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute(array());
        return $seleccionar->rowCount();
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarTurno($patente) {
        $conexion = new DB();
        $sql = "SELECT * FROM reserva, vehiculo, lugar WHERE Vehiculo_idVehiculo = idVehiculo AND Lugar_idLugar = idLugar";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if((trim($validar['patente']) == trim($patente) && $validar['Estado'] == 'Ocupado') || trim($patente) == NULL ){
                       return false;
                   }
        } 
        return true;
    }
    
    public function ValidarTurno2($patente,$idReserva) {
        $conexion = new DB();
        $sql = "SELECT * FROM reserva, lugar, vehiculo WHERE idReserva != '$idReserva'";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if((trim($validar['patente']) == trim($patente) && $validar['Estado'] == 'Ocupado') || trim($patente) == NULL ){
                       return false;
                   }
        } 
        return true;
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteTurno($idTurno) {
        $conexion = new DB();
        //Eliminar reserva
        $sql = "DELETE FROM reserva WHERE idReserva = '$idTurno'";
        $eliminar = $conexion->conectar()->prepare($sql);
        $eliminar->execute();       
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSCAR
    ////////////////////////////////////////////////////////////////////////////
    protected function SearchCaja($caja) {
        $conexion = new DB();
        $sql = "SELECT * FROM reserva, caja, vehiculo, usuario, lugar WHERE Caja_idCaja = idCaja AND idCaja LIKE '$caja' AND idVehiculo = Vehiculo_idVehiculo AND Usuario_idUsuario = idUsuario AND idLugar = Lugar_idLugar";
        $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->caja_arr[]=$objetoconsulta;
        }   
        return $this->caja_arr;
    }
    protected function SearchPatente($patente) {
        $conexion = new DB();
        $sql = "SELECT * FROM reserva, caja, vehiculo, usuario, lugar WHERE Caja_idCaja = idCaja AND patente LIKE '$patente' AND idVehiculo = Vehiculo_idVehiculo AND Usuario_idUsuario = idUsuario AND idLugar = Lugar_idLugar";
        $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->pat_arr[]=$objetoconsulta;
        }   
        return $this->pat_arr;        
    }
}

?>