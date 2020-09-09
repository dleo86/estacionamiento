<?php

require_once ('clases/lugar.php');

$lugar = new Lugar();


class lugarController extends Lugar{
    public $instanciacontrolador;
    public $matrizLugar;
    public $mostrarModal;
    public $filaLugar;
    
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
   public function SelectView($lugar,$pagina,$hasta) {
       /////////////////////////////////////////////////////////////////////////
       //PAGINACIÓN
       /////////////////////////////////////////////////////////////////////////
       $this->tamanho_paginas= $hasta;
       $empezar_desde = ($pagina-1)*$this->tamanho_paginas;
       $tamanho_paginas = $this->tamanho_paginas;
       $num_filas = $lugar->Paginacion();
       $total_paginas = ceil($num_filas/$tamanho_paginas);
       /////////////////////////////////////////////////////////////////////////
       $matrizLugar = $lugar->SelectLugar($empezar_desde, $tamanho_paginas); 
       $idLugar = (isset($_POST['idLugar']))?$_POST['idLugar']:'';
       $accion = (isset($_POST['accion']))?$_POST['accion']:'';  
       if($accion){
            $filaLugar=$lugar->LugarSeleccionado($idLugar);
         }
       require_once ('vistas/vista_lugar.php');
    }
     ////////////////////////////////////////////////////////////////////////////
    //INSERTAR
    ////////////////////////////////////////////////////////////////////////////
    public function InsertLugarController($lugar) {
        //Datos Lugar
        $idLugar = '';
        $Lugar = (isset($_POST['lug']))?$_POST['lug']:'';            
        $Insertar1 = $lugar->InsertLugar($Lugar);  
    }
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZAR
    ////////////////////////////////////////////////////////////////////////////
    public function UpdateLugarController($lugar) {
        //Datos Caja
        $idLugar = (isset($_POST['idLugar1']))?$_POST['idLugar1']:'';;
        $Lugar = (isset($_POST['Lugar1']))?$_POST['Lugar1']:'';
        //$fechaLugar = (isset($_POST['fecha1']))?$_POST['fecha1']:'';
               
        $Actualizar1 = $lugar->UpdateLugar($idLugar, $Lugar);      
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteLugarController($lugar) {
        $idLugar = (isset($_POST['idLugar']))?$_POST['idLugar']:'';
        $Borrar = $lugar->DeleteLugar($idLugar);        
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarInsert($lugar) {
        $nom = (isset($_POST['lug']))?$_POST['lug']:'';
        $valido = $lugar->ValidarLugar($nom);
        return $valido;
    }
    
    public function ValidarUpdate($lugar) {
        $nom = (isset($_POST['Lugar1']))?$_POST['Lugar1']:'';
        $idLug = (isset($_POST['idLugar1']))?$_POST['idLugar1']:'';
        $valido = $lugar->ValidarLugarUpdate($idLug,$nom);
        return $valido;
    }
    
    public function ValidarDelete($lugar) {
        $estado = (isset($_POST['est']))?$_POST['est']:'';
        //$valido = $lugar->ValidarLugarDelete($estado);
        if($estado == 'Ocupado'){
            $valido = false;
        }else{
            $valido = true;
        }
        return $valido;
    }
    
}

    $controlador = new lugarController();
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
                header("Location:menu_lugar.php");
            }
            else{
                $pagina=$_GET['pagina'];
            }       
        } else {
            $pagina = 1;
        }
    ///////////////////////////////////////////////////////////////////////
    if (isset($_POST['btnAgregar'])){
        if ($controlador->ValidarInsert($lugar)){
           $controlador->InsertLugarController($lugar);    
        } else{
            echo 'Codigo invalido';
        }
   }
    if (isset($_POST['btnModificar'])){
        if ($controlador->ValidarUpdate($lugar)){
            $controlador->UpdateLugarController($lugar); 
        }else{
            echo 'Codigo invalido';
        }
    }
    if (isset($_POST['btnEliminar'])){ 
        if ($controlador->ValidarDelete($lugar)){
            $controlador->DeleteLugarController($lugar);
        }else{
            echo 'Lugar ocupado, no se puede eliminar';
        }
    }
     if(isset($_POST['btnBuscar1'])){           
           $controlador->SearchFechaController($lugar);
    }
    $controlador->SelectView($lugar,$pagina,$hasta);    
?>
