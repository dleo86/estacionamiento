<?php

require_once ('clases/cliente.php');

$cli = new Cliente();


class insClienteController extends Cliente{
    public $instanciacontrolador;
    public $matrizCliente;
    public $mostrarModal;
    public $filaCliente;
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectView($cli) {
       /////////////////////////////////////////////////////////////////////////
       //PAGINACIÓN
       /////////////////////////////////////////////////////////////////////////
     //  $tamanho_paginas= 5;
      // $empezar_desde = ($pagina-1)*$tamanho_paginas;
      // $num_filas = $cli->Paginacion();
       //$total_paginas = ceil($num_filas/$tamanho_paginas); 
       /////////////////////////////////////////////////////////////////////////
      /* $matrizCliente = $cli->SelectCliente(); 
       $cliID1 = (isset($_POST['idCli']))?$_POST['idCli']:'';
       $accion = (isset($_POST['accion']))?$_POST['accion']:'';  
       if($accion){
            $filaCliente=$cli->CliSeleccionado($cliID1);
         }*/
       require ('vistas/vista_insCliente.php');
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarInsert($cli) {
        $dniPers = (isset($_POST['dni']))?$_POST['dni']:'';
        $valido = $cli->ValidarCliente($dniPers);
        return $valido;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //INSERTAR
    ////////////////////////////////////////////////////////////////////////////
    public function InsertCli($cli) {
        //Datos Cliente
        $idcli = (isset($_POST['idCliente']))?$_POST['idCliente']:'';
        //Datos Persona
        $nomPers = (isset($_POST['nomPersona']))?$_POST['nomPersona']:'';
        $apelPers = (isset($_POST['apelPersona']))?$_POST['apelPersona']:'';
        $nacPers = (isset($_POST['nac']))?$_POST['nac']:'';
        $telPers = (isset($_POST['tel']))?$_POST['tel']:'';
        $dniPers = (isset($_POST['dni']))?$_POST['dni']:'';
        //Datos Domicilio
        $calle = (isset($_POST['dir']))?$_POST['dir']:'';
        $numDom = (isset($_POST['nro']))?$_POST['nro']:'';
        $piso = (isset($_POST['piso']))?$_POST['piso']:'';
        $dpto = (isset($_POST['dpto']))?$_POST['dpto']:'';
        //Datos Vehiculo
        $patente = (isset($_POST['patente']))?$_POST['patente']:'';
        $marca = (isset($_POST['marca']))?$_POST['marca']:'';
        $modelo = (isset($_POST['modelo']))?$_POST['modelo']:'';
        $anio = (isset($_POST['anio']))?$_POST['anio']:'';
        
        $Insertar1 = $cli->InsertDomicilio($calle, $numDom, $piso, $dpto);
       
        $Insertar2 = $cli->InsertPersona($nomPers, $apelPers, $nacPers, $telPers, $dniPers);        
        
        $Insertar3 = $cli->InsertVehiculo($patente, $marca, $modelo, $anio);        

        $Insertar4 = $cli->InsertCliente();   
        
    }

    
}

    $controlador = new insClienteController();
    $error = array(); 
    $_SESSION['Mensaje'] = '';
    /*
    if(isset($_GET['pagina'])){       
            if ($_GET['pagina']==1){
                header("Location:menu_cliente.php");
            }
            else{
                $pagina=$_GET['pagina'];
            }       
        } else {
            $pagina = 1;
        }*/
    if (isset($_POST['btnAgregar'])){
        //if ($controlador->ValidarInsert($cli)){
            $controlador->InsertCli($cli);
        //}else{
          // $_SESSION['Mensaje'] = 'Código invalido';
         // echo 'Codigo invalido';
        //}   
    }
   
    $controlador->SelectView($cli);

?>
