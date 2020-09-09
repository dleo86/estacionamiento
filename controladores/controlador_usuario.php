<?php

require_once ('clases/usuario.php');

$user = new Usuario1();


class usuarioController extends Usuario1{
    public $instanciacontrolador;
    public $matrizUsuario;
    public $mostrarModal;
    public $filaUsuario;
   // public $filaLoc;
   // public $filaIva;
  
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectView($user,$pagina,$hasta) {
        /////////////////////////////////////////////////////////////////////////
       //PAGINACIÓN
       /////////////////////////////////////////////////////////////////////////
       $this->tamanho_paginas= $hasta;
       $empezar_desde = ($pagina-1)*$this->tamanho_paginas;
       $tamanho_paginas = $this->tamanho_paginas;
       $num_filas = $user->Paginacion();
       $total_paginas = ceil($num_filas/$tamanho_paginas);
       /////////////////////////////////////////////////////////////////////////
       $matrizUsuario = $user->SelectUsuario($empezar_desde, $tamanho_paginas); 
      // $filaLoc = $cli->SelectLoc();
      // $filaIva = $cli->SelectIva();
       $userID1 = (isset($_POST['idUser']))?$_POST['idUser']:'';
       $accion = (isset($_POST['accion']))?$_POST['accion']:'';  
       if($accion){
            $filaUsuario=$user->UserSeleccionado($userID1);
         }
       require ('vistas/vista_usuario.php');
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////   
    public function ValidarUpdate($user) {
        $username = (isset($_POST['userName1']))?$_POST['userName1']:'';
        $idUser = (isset($_POST['idUsuario']))?$_POST['idUsuario']:'';
        $valido = $user->ValidarUsuario2($idUser,$username);
        return $valido;
    }
  
    ////////////////////////////////////////////////////////////////////////////
    //ACTUALIZAR
    ////////////////////////////////////////////////////////////////////////////
    public function UpdateUsuario($user) {
        //Datos Usuario
        $idUser = (isset($_POST['idUsuario1']))?$_POST['idUsuario1']:'';
        $userName = (isset($_POST['userName1']))?$_POST['userName1']:'';
        $userPass = (isset($_POST['userPass1']))?$_POST['userPass1']:'';
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

        
        $Actualizar1 = $user->UpdateDomicilio($idDom, $calle, $numDom, $piso, $dpto);
       
        $Actualizar2 = $user->UpdatePersona($idPers, $nomPers, $apelPers, $nacPers, $telPers, $dniPers);           
        
        $Actualizar3 = $user->UpdateUser($idUser,$userName,$userPass);
        //$Actualizar3 = $user->UpdateVehiculo($idVec, $patente, $marca, $modelo, $anio);
    }
    ////////////////////////////////////////////////////////////////////////////
    //ELIMINAR
    ////////////////////////////////////////////////////////////////////////////
    public function DeleteUsuarioController($user) {
        $idUs = (isset($_POST['idUser']))?$_POST['idUser']:'';
        $idPers = (isset($_POST['idPers']))?$_POST['idPers']:'';
        $idDom = (isset($_POST['idDom']))?$_POST['idDom']:'';
        $Borrar = $user->DeleteUsuario($idUs, $idPers, $idDom);        
    }
    ////////////////////////////////////////////////////////////////////////////
    //BUSCAR
    ////////////////////////////////////////////////////////////////////////////     
    public function SearchUsuarioController($user,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $user->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $usuario = (isset($_POST['buscarUsuario']))?$_POST['buscarUsuario']:'';
        if (!empty($usuario)){
            $matrizUsuario = $user->SearchUsuario($usuario);
            if (isset($matrizUsuario)){
                require_once('vistas/vista_usuario.php');              
            } else{
                echo 'No se ha encontrado el usuario';
            }
        } 
    }
    
    public function SearchApelController($user,$pagina) {
        $tamanho_paginas= 5;
        $num_filas = $user->Paginacion();
        $total_paginas = ceil($num_filas/$tamanho_paginas);
        $apellido = (isset($_POST['buscarApel']))?$_POST['buscarApel']:'';
        if (!empty($apellido)){
            $matrizUsuario = $user->SearchApel($apellido);
            if (isset($matrizUsuario)){
                require_once('vistas/vista_usuario.php');              
            } else{
                echo 'No se ha encontrado el apellido';
            }
        } 
    }
    
}

    $controlador = new usuarioController();
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
                header("Location:menu_usuario.php");
            }
            else{
                $pagina=$_GET['pagina'];
            }       
        } else {
            $pagina = 1;
        }
    ///////////////////////////////////////////////////////////////////////
    if (isset($_POST['btnModificar'])){
        if ($controlador->ValidarUpdate($user)){
            $controlador->UpdateUsuario($user);
        }else{
          // $_SESSION['Mensaje'] = 'Código invalido';
            echo 'Codigo invalido';
        }
    }
    if (isset($_POST['btnEliminar'])){      
            $controlador->DeleteUsuarioController($user);
    }
    if(isset($_POST['btnBuscar1'])){           
           $controlador->SearchUsuarioController($user,$pagina);
    }
    if(isset($_POST['btnBuscar2'])){           
           $controlador->SearchApelController($user,$pagina);
    }
    $controlador->SelectView($user,$pagina,$hasta);

?>
