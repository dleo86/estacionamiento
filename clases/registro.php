<?php
$error = array();

class Registro{
    protected $nombre;
    protected $password;
    protected $idPersona;
    protected $usuario;
    protected $datos;
    protected $apel_arr;
    protected $us_arr;
    public $sentencia;

    public function __construct() {   
        //$conexion = new DB();
        require_once 'db.php';
        $this->usuario=array();
        $this->datos=array();
    }
    ////////////////////////////////////////////////////////////////////////////
    //INSERCIONES
    ////////////////////////////////////////////////////////////////////////////   
    protected function InsertDomicilio($calle, $numDom, $piso, $dpto) {
        $conexion = new DB();
        $sql = "INSERT INTO domicilio(idDomicilio, calleDom, numDom, pisoDom, dptoDom) VALUES (default,  :calleDom, :numDom, :pisoDom, :dptoDom)";
        $insertar = $conexion->conectar()->prepare($sql);
        $insertar->execute(array(":calleDom"=>$calle, ":numDom"=>$numDom,":pisoDom"=>$piso, ":dptoDom"=>$dpto ));       
    }
    
    protected function InsertPersona($nomPers, $apelPers, $nacPers, $telPers, $dniPers) {
        $conexion = new DB();
        $sql = "INSERT INTO persona(idPersona, nomPersona, apelPersona, nacPersona, telPersona, dniPersona, Domicilio_idDomicilio) VALUES (default, :nomPersona, :ApelPersona, :nacPersona, :telPersona, :dniPersona, (SELECT MAX(idDomicilio) FROM domicilio))";
        $insertar = $conexion->conectar()->prepare($sql);
        $insertar->execute(array(":nomPersona"=>$nomPers, ":ApelPersona"=>$apelPers,":nacPersona"=>$nacPers, ":telPersona"=>$telPers, ":dniPersona"=>$dniPers ));
    }
    
    protected function InsertUsuario($userName,$userPass,$userPriv) {
        $conexion = new DB();
        $pass_cifrado= password_hash($userPass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario(idUsuario, userName, userPass, userPriv, userIngreso, Persona_idPersona) VALUES (default, :userName, :userPass, :userPriv, now(),(SELECT MAX(idPersona) FROM persona))";
        $insertar = $conexion->conectar()->prepare($sql);
        $insertar->execute(array(":userName"=>$userName, ":userPass"=>$pass_cifrado, ":userPriv"=>$userPriv));
    }
    ////////////////////////////////////////////////////////////////////////////
    //VALIDACIONES
    ////////////////////////////////////////////////////////////////////////////
    public function ValidarUsuario($userName,$userPass) {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($validar=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   if((strcmp(trim($validar['userName']),$userName) === 0) || password_verify($userPass, $validar['userPass'])){   
                       return false;
                   }
        }
        return true;
    }     
    ////////////////////////////////////////////////////////////////////////////
    //SELECCIONES
    ////////////////////////////////////////////////////////////////////////////
    public function SelectUsuario() {
        $conexion = new DB();
        $sql = "SELECT * FROM usuario, persona, domicilio WHERE Persona_idPersona = idPersona AND Domicilio_idDomicilio = idDomicilio ORDER BY idUsuario DESC";
        $seleccionar = $conexion->conectar()->prepare($sql);
        $seleccionar->execute();
        while($filas=$seleccionar->fetch(PDO::FETCH_ASSOC)){
                   $this->usuario[]=$filas;
        } 
        return $this->usuario;
    }

}

?>
