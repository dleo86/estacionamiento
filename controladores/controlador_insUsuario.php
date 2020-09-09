<?php

require_once ('clases/usuario.php');

$user = new Usuario1();

class insUsuarioController extends Usuario1{
    public $instanciacontrolador;
    public $matrizUsuario;
    public $mostrarModal;
    public $filaUsuario;
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectView($user) {
      
       require ('vistas/vista_insUsuario.php');
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDAR
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarInsert($user) {
        $userName = (isset($_POST['user']))?$_POST['user']:'';
        $valido = $user->ValidarUsuario($userName);
        return $valido;
    }
    
     ////////////////////////////////////////////////////////////////////////////
    //INSERTAR
    ////////////////////////////////////////////////////////////////////////////
    public function InsertUsuario($user) {
        //Datos Usuario
        $idUser = (isset($_POST['idUsuario']))?$_POST['idUsuario']:'';
        $nomUser = (isset($_POST['user']))?$_POST['user']:'';
        $passUser = (isset($_POST['pass']))?$_POST['pass']:'';
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
        
        $Insertar1 = $user->InsertDomicilio($calle, $numDom, $piso, $dpto);
       
        $Insertar2 = $user->InsertPersona($nomPers, $apelPers, $nacPers, $telPers, $dniPers);        
        
        $Insertar4 = $user->InsertUser($nomUser,$passUser);   
        
    }
    
}

    $controlador = new insUsuarioController();
    $error = array(); 
    $_SESSION['Mensaje'] = '';
    
    if (isset($_POST['btnAgregar'])){
        if ($controlador->ValidarInsert($user)){
            $controlador->InsertUsuario($user);
        }else{
          // $_SESSION['Mensaje'] = 'Código invalido';
            echo 'Codigo invalido';
        }   
    }
   
    $controlador->SelectView($user);

?>
