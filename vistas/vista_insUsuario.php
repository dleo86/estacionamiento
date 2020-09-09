<!doctype html>

<body>
   
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <!-- Navbar content -->
  <span class="openbtn">
      <button class="openbtn1" onclick="Nav()">&#9776;</button>
      <img src="img/logo1.png">
  </span>  
<div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="img/images.png" alt="User Avatar" height="40px" width="40px">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="cerrar.php" style="color: #2d690e;"><i class="fa fa-power-off"></i> Salir</a>
                        </div>
  </div>  
</nav>
    <div id="contenedor" class="container-fluid">
        <div class="row" id="row" style="width: 1428px">
         <?php include_once('includes/sidebar.php');?>
        <form action="" method="post" enctype="">   
                <!-- Modal: Abre la ventana para modificar -->
                <div class="modal-dialog" role="document" id="registro">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Insertar Usuario</h5>                              
                    </div>                             
        <div class="modal-body">
            <div class="form-row">  
                <div class="form-group col-md-4">
                    <label for="">Usuario: </label>
                    <input type="text" name="user" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="" placeholder="" id="txtNombre" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Contraseña: </label>
                    <input type="password" name="pass" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="" placeholder="" id="txtNombre" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Nombre: </label>
                    <input type="text" name="nomPersona" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="" placeholder="" id="txtNombre" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                    <div class="form-group col-md-4">
                    <label for="">Apellido: </label>
                    <input type="text" name="apelPersona" class="form-control <?php //echo (isset($error['ApellidoP']))?"is-invalid":""; ?>"  value="" placeholder="" id="txtApellidoP" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['ApellidoP']))?$error['ApellidoP']:""; ?>
                    </div>
                    <br>
                </div>
                 <div class="form-group col-md-4">
                    <label for="">Fecha nac: </label>
                    <input type="date" name="nac" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Teléfono: </label>
                    <input type="text" name="tel" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>               
                <div class="form-group col-md-4">
                    <label for="">DNI: </label>
                    <input type="number" name="dni" class="form-control" value="" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['ApellidoM']))?$error['ApellidoM']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Dirección: </label>
                    <input type="text" name="dir" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="" placeholder="" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Nro: </label>
                    <input type="number" name="nro" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="" placeholder="" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Piso: </label>
                    <select class="form-control" name="piso" >                       
                         <?php for($piso = 0; $piso < 55; $piso++){ ?>
			<?php echo "<option value='". $piso. "'>". $piso . "</option>"; ?>
			<?php } ?>
                    </select>                   
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Dpto: </label>
                    <input type="text" name="dpto" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>                    
                           
        </div>
        </div>
        <div class="modal-footer">
                <button value="btnAgregar" class="btn btn-primary" type="submit" name="btnAgregar">Agregar</button>                               
        </div>
        </div>
        </div>
             
    </form>
   </div>
    </div>
    
     <?php include_once('includes/footer.php');?>
</body>
</html>
