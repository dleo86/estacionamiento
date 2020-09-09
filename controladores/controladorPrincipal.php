<?php


$start = new StarterController();
class StarterController{
    
    public function __construct() {
        session_start();
    }
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONAR
    ////////////////////////////////////////////////////////////////////////////
    public function SelectView() {
        
        require_once ('vistas/vista_index.php');
    }
    
   /* public function redirect() {
        header("location: usuarioController.php?action=login");
    }*/
}

if (isset($_SESSION['userName'])){
   // if (isset($_POST['articulos'])){
     //       require_once ('controlador/articuloController.php');
       // }
        $start->SelectView();
}else{
       header('Location: login.php');
}	      
?>



