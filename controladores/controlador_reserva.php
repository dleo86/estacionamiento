<?php

require_once ('clases/reserva.php');

$turno = new Reserva();


class reservaController extends Reserva{
    public $instanciacontrolador;
    public $matrizTurno;
    public $mostrarModal;
    public $filaTurno;

    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectView($turno,$pagina,$hasta) {
       /////////////////////////////////////////////////////////////////////////
       //PAGINACIÓN
       /////////////////////////////////////////////////////////////////////////
       $this->tamanho_paginas= $hasta;
       $empezar_desde = ($pagina-1)*$this->tamanho_paginas;
       $tamanho_paginas = $this->tamanho_paginas;
       $num_filas = $turno->Paginacion();
       $total_paginas = ceil($num_filas/$tamanho_paginas);
       /////////////////////////////////////////////////////////////////////////
       $matrizTurno = $turno->SelectTurno($empezar_desde, $tamanho_paginas); 
       $filaLugar = $turno->SelectLugar();
       $filaVehiculo = $turno->SelectVehic();
       $idTurno = (isset($_POST['idTurno']))?$_POST['idTurno']:'';
       $accion = (isset($_POST['accion']))?$_POST['accion']:'';  
       if($accion){
            $filaTurno=$turno->TurnoSeleccionado($idTurno);
       }
       require_once ('vistas/vista_reserva.php');
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarInsert($turno) {
        $patente = (isset($_POST['patente']))?$_POST['patente']:'';
        $valido = $turno->ValidarTurno($patente);
        return $valido;
    }
    
    public function ValidarUpdate($turno) {
        $patente = (isset($_POST['patente1']))?$_POST['patente1']:'';
        $idReserva = (isset($_POST['idReserva']))?$_POST['idReserva']:'';
        $valido = $turno->ValidarTurno2($patente,$idReserva);
        return $valido;
    }
    ////////////////////////////////////////////////////////////////////////////
    //INSERTAR
    ////////////////////////////////////////////////////////////////////////////
    public function InsertTurnoControlador($turno) {
        //Datos Turno
        $idTurno = (isset($_POST['idTurno']))?$_POST['idTurno']:'';
        $desde = (isset($_POST['desde']))?$_POST['desde']:'';
        $hasta = (isset($_POST['hasta']))?$_POST['hasta']:'';
        $costo = (isset($_POST['costo']))?$_POST['costo']:'50';
        //Datos Lugar
        $idLugar = (isset($_POST['lugar']))?$_POST['lugar']:'';
        //Datos Caja
        $idCaja = (isset($_POST['caja']))?$_POST['caja']:'';
        //Datos Usuario
        $Usuario = (isset($_POST['usuario']))?$_POST['usuario']:'';
        //Datos Vehiculo
        $idVehiculo = (isset($_POST['nro']))?$_POST['nro']:'';
        $patente = (isset($_POST['patente']))?$_POST['patente']:'';
        $marca = (isset($_POST['marca']))?$_POST['marca']:'';
        $modelo = (isset($_POST['modelo']))?$_POST['modelo']:'';
        $anio = (isset($_POST['anio']))?$_POST['anio']:'';
        
        $Insertar1 = $turno->InsertVehiculo($patente);       

        $Insertar2 = $turno->InsertTurno($desde,$hasta,$costo,$idLugar,$idCaja,$Usuario,$idVehiculo);
        
        $Update1 = $turno->UpdateLugar($idLugar);
        
    }
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZAR
    ////////////////////////////////////////////////////////////////////////////
     public function ActualzarTurnoControlador($turno) {
        //Datos Turno
        $idTurno = (isset($_POST['idTurno']))?$_POST['idTurno']:'';
        $desde = (isset($_POST['desde']))?$_POST['desde']:'';
        //$d = new DateTime('', new DateTimeZone('America'));
        date_default_timezone_set('UTC'); 
        $hasta = date("Y-m-d h:i:s");//$d->format('Y-m-d H:i:s');
        $total = (isset($_POST['costo']))?$_POST['costo']:50;
        //Datos Lugar
        $idLugar = (isset($_POST['idLugar']))?$_POST['idLugar']:'';
        //Datos Caja
        $idCaja = (isset($_POST['caja']))?$_POST['caja']:'';
        //Datos Usuario
        $idUsuario = (isset($_POST['usuario']))?$_POST['usuario']:'';
        //Datos Vehiculo
        $idVehiculo = (isset($_POST['nro']))?$_POST['nro']:'';
        $patente = (isset($_POST['patente']))?$_POST['patente']:'';
        $marca = (isset($_POST['marca']))?$_POST['marca']:'';
        $modelo = (isset($_POST['modelo']))?$_POST['modelo']:'';
        $anio = (isset($_POST['anio']))?$_POST['anio']:'';
        
        
        $Actualizar1 = $turno->actualizarTurno($idTurno,$hasta);  
        
        $Update2 = $turno->UpdateLugar2($idLugar);
       // $Insertar2 = $turno->InsertTurno($desde,$hasta,$costo,$idLugar,$idCaja,$idUsuario,$idVehiculo);
        
        //$Update1 = $turno->UpdateLugar($idLugar);
        
    }
    
    public function UpdateTurnoControlador($turno) {
        //Datos Cliente
        $idTurno = (isset($_POST['idTurno1']))?$_POST['idTurno1']:'';
        //Datos Persona
      /*  $idPers = (isset($_POST['IDpers1']))?$_POST['IDpers1']:'';
        $nomPers = (isset($_POST['nomPersona1']))?$_POST['nomPersona1']:'';
        $apelPers = (isset($_POST['apelPersona1']))?$_POST['apelPersona1']:'';
        $nacPers = (isset($_POST['nac1']))?$_POST['nac1']:'';
        $telPers = (isset($_POST['tel1']))?$_POST['tel1']:'';
        $dniPers = (isset($_POST['dni1']))?$_POST['dni1']:'';
        //Datos Domicilio
        $idDom = (isset($_POST['IDdom1']))?$_POST['IDdom1']:'';
        $calle = (isset($_POST['dir1']))?$_POST['dir1']:'';
        $numDom = (isset($_POST['nro1']))?$_POST['nro1']:'';
        $piso = (isset($_POST['piso1']))?$_POST['piso1']:'';
        $dpto = (isset($_POST['dpto1']))?$_POST['dpto1']:'';*/
         //Datos Vehiculo
        $idVec = (isset($_POST['idVeh1']))?$_POST['idVeh1']:'';
        $patente = (isset($_POST['patente1']))?$_POST['patente1']:'';
        $marca = (isset($_POST['marca1']))?$_POST['marca1']:'';
        $modelo = (isset($_POST['modelo1']))?$_POST['modelo1']:'';
        $anio = (isset($_POST['anio1']))?$_POST['anio1']:'';
        
       // $Actualizar1 = $turno->UpdateDomicilio($idDom, $calle, $numDom, $piso, $dpto);
       
        //$Actualizar2 = $turno->UpdatePersona($idPers, $nomPers, $apelPers, $nacPers, $telPers, $dniPers);           
        
       // $Actualizar3 = $turno->UpdateVehiculo($idVec, $patente, $marca, $modelo, $anio);
        
        $Actualizar4 = $turno->UpdateReserva($idVec, $patente);
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteTurnoController($turno) {
        $idTurno = (isset($_POST['idTurno']))?$_POST['idTurno']:'';
        //$idPers = (isset($_POST['idPers']))?$_POST['idPers']:'';
        //$idDom = (isset($_POST['idDom']))?$_POST['idDom']:'';
        //$idVehic = (isset($_POST['idVehic']))?$_POST['idVehic']:'';
        $Borrar = $turno->DeleteTurno($idTurno);        
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSCAR
    ////////////////////////////////////////////////////////////////////////////     
    public function SearchCajaController($turno,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $turno->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $caja = (isset($_POST['buscarCaja']))?$_POST['buscarCaja']:'';
        if (!empty($caja)){
            $matrizTurno = $turno->SearchCaja($caja);
            if (isset($matrizTurno)){
                require_once('vistas/vista_reserva.php');              
            } else{
                echo 'No se ha encontrado la caja';
            }
        } 
    }
    
    public function SearchPatenteController($turno,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $turno->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $patente = (isset($_POST['buscarPatente']))?$_POST['buscarPatente']:'';
        if (!empty($patente)){
            $matrizTurno = $turno->SearchPatente($patente);
            if (isset($matrizTurno)){
                require_once('vistas/vista_reserva.php');              
            } else{
                echo 'No se ha encontrado la patente';
            }
        } 
    }
    
}

    $controlador = new reservaController();
    $error = array(); 
  
    $_SESSION['Mensaje'] = '';
    //Cantidad de filas a mostrar
    if(isset($_POST['fila1'])){
        $hasta = 5;
        $_SESSION['valor'] = 1;
    }else if (isset($_POST['fila2']) || isset($_SESSION['valor']) == 2){
        $hasta = 10;
       $_SESSION['valor'] = 2;
    } else if (isset($_POST['fila3']) || isset($_SESSION['valor']) == 3){
        $hasta = 15;
        $_SESSION['valor'] = 3;
    } else {
        $hasta = 5;
    }
     ///////////////////Paginación////////////////////////////////
    if(isset($_GET['pagina'])){       
            if ($_GET['pagina']==1){
                header("Location:menu_reserva.php");
            }
            else{
                $pagina=$_GET['pagina'];
            }       
        } else {
            $pagina = 1;
        }
    ///////////////////////////////////////////////////////////////////////
    if (isset($_POST['btnAgregar'])){
        if ($controlador->ValidarInsert($turno)){
            $controlador->InsertTurnoControlador($turno);
        }else{
           //$_SESSION['Mensaje'] = 'Código invalido';
           echo 'Código invalido';
        }   
    }
     if (isset($_POST['btnDesocupar'])){
       // if ($controlador->ValidarInsert($cli)){
            $controlador->ActualzarTurnoControlador($turno);
        //}else{
          // $_SESSION['Mensaje'] = 'Código invalido';
        //}   
    }
    if (isset($_POST['btnModificar'])){
        if ($controlador->ValidarUpdate($turno)){
            $controlador->UpdateTurnoControlador($turno);
        }else{
           //$_SESSION['Mensaje'] = 'Código invalido';
           echo 'Código invalido';
        }
    }
    if (isset($_POST['btnEliminar'])){      
            $controlador->DeleteTurnoController($turno);
    }
    if(isset($_POST['btnBuscar1'])){
           $controlador->SearchCajaController($turno,$pagina);
    }
    if(isset($_POST['btnBuscar2'])){           
           $controlador->SearchPatenteController($turno,$pagina);
    }
    $controlador->SelectView($turno,$pagina,$hasta);

?>
