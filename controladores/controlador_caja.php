<?php

require_once ('clases/caja.php');

$caja = new Caja();


class cajaController extends Caja{
    public $instanciacontrolador;
    public $matrizCaja;
    public $mostrarModal;
    public $filaCaja;
    
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
   public function SelectView($caja,$pagina,$hasta) {
        /////////////////////////////////////////////////////////////////////////
       //PAGINACIÓN
       /////////////////////////////////////////////////////////////////////////
       $this->tamanho_paginas= $hasta;
       $empezar_desde = ($pagina-1)*$this->tamanho_paginas;
       $tamanho_paginas = $this->tamanho_paginas;
       $num_filas = $caja->Paginacion();
       $total_paginas = ceil($num_filas/$tamanho_paginas);
       /////////////////////////////////////////////////////////////////////////
       $matrizCaja = $caja->SelectCaja($empezar_desde, $tamanho_paginas); 
       $idCaja = (isset($_POST['idCaja']))?$_POST['idCaja']:'';
       $accion = (isset($_POST['accion']))?$_POST['accion']:'';  
       if($accion){
            $filaCaja=$caja->CajaSeleccionado($idCaja);
         }
       require_once ('vistas/vista_caja.php');
    }
     ////////////////////////////////////////////////////////////////////////////
    //INSERTAR
    ////////////////////////////////////////////////////////////////////////////
    public function InsertCajaController($caja) {
        //Datos Caja
        $idCaja = '';
        $totalCaja = (isset($_POST['total']))?$_POST['total']:'';
        $fechaCaja = (isset($_POST['fecha']))?$_POST['fecha']:'';
               
        $Insertar1 = $caja->InsertCaja($totalCaja, $fechaCaja);
       
    }
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZAR
    ////////////////////////////////////////////////////////////////////////////
    public function UpdateCajaController($caja) {
        //Datos Caja
        $idCaja = (isset($_POST['idCaja1']))?$_POST['idCaja1']:'';;
        $totalCaja = (isset($_POST['total1']))?$_POST['total1']:'';
        $fechaCaja = (isset($_POST['fecha1']))?$_POST['fecha1']:'';
               
        $Actualizar1 = $caja->UpdateCaja($idCaja, $totalCaja, $fechaCaja);      
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteCajaController($caja) {
        $idcaja = (isset($_POST['idCaja']))?$_POST['idCaja']:'';
        $Borrar = $caja->DeleteCaja($idcaja);        
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSCAR
    ////////////////////////////////////////////////////////////////////////////
   public function SearchFechaController($caja,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $caja->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $fecha = (isset($_POST['BuscarFecha']))?$_POST['BuscarFecha']:'';
        if (!empty($fecha)){
            $matrizCaja = $caja->SearchFecha($fecha);
            if (isset($matrizCaja)){
                require_once('vistas/vista_caja.php');              
            } else{
                echo 'No se ha encontrado ninguna caja con esa fecha';
            }
        } 
    }
    
}

    $controlador = new cajaController();
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
                header("Location:menu_caja.php");
            }
            else{
                $pagina=$_GET['pagina'];
            }       
        } else {
            $pagina = 1;
        }
    /////////////////////////////////////////////////////////////////    
    if (isset($_POST['btnAgregar'])){
        $controlador->InsertCajaController($caja);        
   }
    if (isset($_POST['btnModificar'])){
            $controlador->UpdateCajaController($caja);      
    }
    if (isset($_POST['btnEliminar'])){      
            $controlador->DeleteCajaController($caja);
    }
     if(isset($_POST['btnBuscar1'])){           
           $controlador->SearchFechaController($caja,$pagina);
    }
    $controlador->SelectView($caja,$pagina,$hasta);    
?>
