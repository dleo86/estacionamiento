<?php


$txtID1 = (isset($_POST['txtID1']))?$_POST['txtID1']:'';
$accion = (isset($_POST['accion']))?$_POST['accion']:'';
$error = array();

class Cliente{
    protected $idPersona;
    protected $cliente;
    protected $datos;
    protected $nomCli;
    protected $Localidad;
    protected $Iva;
    public $sentencia;
    protected $pat_arr;
    protected $apel_arr;
    public $tamanho_paginas;
    ////////////////////////////////////////////////////////////////////////////
    //CONSTRUCTOR
    ////////////////////////////////////////////////////////////////////////////
    public function __construct() {   
        //$conexion = new DB();
        require_once 'db.php';
        $this->cliente=array();
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
    
    protected function InsertVehiculo($patente, $marca, $modelo, $anio) {
        $conexion = new DB();
        $sql = "INSERT INTO vehiculo ( idVehiculo, patente, marca, modelo, anio) VALUES (default, :patente, :marca, :modelo, :anio)";
        $insertar = $conexion->conectar()->prepare($sql);      
        $insertar->execute(array(":patente"=>$patente, ":marca"=>$marca, ":modelo"=>$modelo, ":anio"=>$anio));
    }
    
    protected function InsertCliente() {
        $conexion = new DB();
        $sql = "INSERT INTO cliente ( idCliente, Vehiculo_idVehiculo, Persona_idPersona) VALUES (default, (SELECT MAX(idVehiculo) FROM vehiculo), (SELECT MAX(idPersona) FROM persona))";
        $insertar = $conexion->conectar()->prepare($sql);      
        $insertar->execute();
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
    
    public function UpdateVehiculo($idVec,$patente, $marca, $modelo, $anio) {
        $conexion = new DB();
        $sql = "UPDATE vehiculo "
                . "SET patente  = :patente, marca = :marca, modelo = :modelo, anio = :anio WHERE idVehiculo = '$idVec'";
        $actualizar3 = $conexion->conectar()->prepare($sql);
        $actualizar3->execute(array(":patente"=>$patente, ":marca"=>$marca, ":modelo"=>$modelo, ":anio"=>$anio));
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectCliente($empezar_desde, $tamanho_paginas) {
        $conexion = new DB();
        $sql = "SELECT * FROM cliente, vehiculo, persona, domicilio WHERE Persona_idPersona = idPersona AND Domicilio_idDomicilio = idDomicilio AND Vehiculo_idVehiculo = idVehiculo ORDER BY idCliente DESC LIMIT $empezar_desde, $tamanho_paginas";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($filas=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   $this->cliente[]=$filas;
        } 
        return $this->cliente;
    }
    
    public function CliSeleccionado($cliID1) {
        $conexion = new DB();
        $sql1 = "SELECT * FROM cliente, vehiculo, persona, domicilio "
                . "WHERE Persona_idPersona = idPersona AND idCliente = '$cliID1' AND Domicilio_idDomicilio = idDomicilio AND Vehiculo_idVehiculo = idVehiculo";
        $sentencia = $conexion->conectar()->prepare($sql1); 
        $sentencia->execute();
        $fila=$sentencia->fetch(PDO::FETCH_LAZY);
        return $fila;
    }
    //PAGINACION
    public function Paginacion(){
        $conexion = new DB();
        $sql = "SELECT * FROM cliente";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute(array());
        return $seleccionar->rowCount();
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteCliente($idcli,$idPers,$idDom) {
        $conexion = new DB();
        //Eliminar cliente
        $sql1 = "DELETE FROM cliente WHERE idCliente = '$idcli'";
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
    protected function SearchApel($apellido) {
        $conexion = new DB();
        $sql = "SELECT * FROM cliente, persona, vehiculo WHERE Persona_idPersona = idPersona AND idVehiculo = Vehiculo_idVehiculo AND apelPersona LIKE '%$apellido%'";
        $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->apel_arr[]=$objetoconsulta;
        }   
        return $this->apel_arr;
    }
    protected function SearchPatente($patente) {
        $conexion = new DB();
        $sql = "SELECT * FROM cliente, persona, vehiculo WHERE Persona_idPersona = idPersona AND idVehiculo = Vehiculo_idVehiculo AND patente LIKE '$patente'";
        $consulta = $conexion->conectar()->prepare($sql);
        $consulta->execute();
         while($objetoconsulta=$consulta->fetch(PDO::FETCH_ASSOC)){
                   $this->pat_arr[]=$objetoconsulta;
        }   
        return $this->pat_arr;        
    }
}

?>