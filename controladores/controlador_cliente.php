<?php

require_once ('clases/cliente.php');

$cli = new Cliente();


class clienteController extends Cliente{
    public $instanciacontrolador;
    public $matrizCliente;
    public $mostrarModal;
    public $filaCliente;
    public $filaLoc;
    public $filaIva;
  
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectView($cli,$pagina,$hasta) {
       /////////////////////////////////////////////////////////////////////////
       //PAGINACIÓN
       /////////////////////////////////////////////////////////////////////////
       $this->tamanho_paginas= $hasta;
       $empezar_desde = ($pagina-1)*$this->tamanho_paginas;
       $tamanho_paginas = $this->tamanho_paginas;
       $num_filas = $cli->Paginacion();
       $total_paginas = ceil($num_filas/$tamanho_paginas);
       /////////////////////////////////////////////////////////////////////////
       $matrizCliente = $cli->SelectCliente($empezar_desde, $tamanho_paginas); 
      // $filaLoc = $cli->SelectLoc();
      // $filaIva = $cli->SelectIva();
       $cliID1 = (isset($_POST['idCli']))?$_POST['idCli']:'';
       $accion = (isset($_POST['accion']))?$_POST['accion']:'';  
       if($accion){
            $filaCliente=$cli->CliSeleccionado($cliID1);
         }
       require_once ('vistas/vista_clientes.php');
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
 
    public function ValidarUpdate($cli) {
        $nombre = (isset($_POST['nomPersona1']))?$_POST['nomPersona1']:'';
        $apellido = (isset($_POST['apelPersona1']))?$_POST['apelPersona1']:'';
        //$valido = $cli->ValidarCliente2($idPers,$dniPers);
        if ((trim($nombre) == NULL) || (trim($apellido) == NULL)){
            $valido = false;
        }else{
            $valido = true;
        } 
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
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZAR
    ////////////////////////////////////////////////////////////////////////////
    public function UpdateCli($cli) {
        //Datos Cliente
        $idcli = (isset($_POST['idCliente1']))?$_POST['idCliente1']:'';
        //Datos Persona
        $idPers = (isset($_POST['IDpers1']))?$_POST['IDpers1']:'';
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
        $dpto = (isset($_POST['dpto1']))?$_POST['dpto1']:'';
         //Datos Vehiculo
        $idVec = (isset($_POST['idVehic1']))?$_POST['idVehic1']:'';
        $patente = (isset($_POST['patente1']))?$_POST['patente1']:'';
        $marca = (isset($_POST['marca1']))?$_POST['marca1']:'';
        $modelo = (isset($_POST['modelo1']))?$_POST['modelo1']:'';
        $anio = (isset($_POST['anio1']))?$_POST['anio1']:'';
        
        $Actualizar1 = $cli->UpdateDomicilio($idDom, $calle, $numDom, $piso, $dpto);
       
        $Actualizar2 = $cli->UpdatePersona($idPers, $nomPers, $apelPers, $nacPers, $telPers, $dniPers);           
        
        $Actualizar3 = $cli->UpdateVehiculo($idVec, $patente, $marca, $modelo, $anio);
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteCliController($cli) {
        $idcli = (isset($_POST['idCli']))?$_POST['idCli']:'';
        $idPers = (isset($_POST['idPers']))?$_POST['idPers']:'';
        $idDom = (isset($_POST['idDom']))?$_POST['idDom']:'';
       
        $Borrar = $cli->DeleteCliente($idcli, $idPers, $idDom);        
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSCAR
    ////////////////////////////////////////////////////////////////////////////     
    public function SearchApelController($cli,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $cli->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $apellido = (isset($_POST['buscarApel']))?$_POST['buscarApel']:'';
        if (!empty($apellido)){
            $matrizCliente = $cli->SearchApel($apellido);
            if (isset($matrizCliente)){
                require_once('vistas/vista_clientes.php');              
            } else{
                echo 'No se ha encontrado el apellido';
            }
        } 
    }
    
    public function SearchPatenteController($cli,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $cli->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $patente = (isset($_POST['buscarPat']))?$_POST['buscarPat']:'';
        if (!empty($patente)){
            $matrizCliente = $cli->SearchPatente($patente);
            if (isset($matrizCliente)){
                require_once('vistas/vista_clientes.php');              
            } else{
                echo 'No se ha encontrado la patente';
            }
        } 
    }
    
}

    $controlador = new clienteController();
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
                header("Location:menu_clientes.php");
            }
            else{
                $pagina=$_GET['pagina'];
            }       
        } else {
            $pagina = 1;
        }
    ///////////////////////////////////////////////////////////////////////
    if (isset($_POST['btnModificar'])){
        if ($controlador->ValidarUpdate($cli)){
            $controlador->UpdateCli($cli);
        }else{
           //$_SESSION['Mensaje'] = 'Código invalido';
           echo 'Codigo invalido';
        }
    }
    if (isset($_POST['btnEliminar'])){      
            $controlador->DeleteCliController($cli);
    }
    if(isset($_POST['btnBuscar1'])){           
           $controlador->SearchApelController($cli,$pagina);
    }
    if(isset($_POST['btnBuscar2'])){           
           $controlador->SearchPatenteController($cli,$pagina);
    }
    $controlador->SelectView($cli,$pagina,$hasta);

?>
