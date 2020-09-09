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
    <form action="" method="post" enctype="multipart/form-data">   
                <!-- Modal: Abre la ventana para modificar -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                             
        <div class="modal-body">
            <div class="form-row">
                <input type="hidden" name="idUsuario1" value="<?php echo $filaUsuario['idUsuario']; ?>" placeholder="" required >              
                <input type="hidden" name="IDpers1" value="<?php echo $filaUsuario['idPersona']; ?>" placeholder="" required >  
                <input type="hidden" name="IDdom1" value="<?php echo $filaUsuario['idDomicilio']; ?>" placeholder="" required >
                <div class="form-group col-md-4">
                    <label for="">Usuario: </label>
                    <input type="text" name="userName1" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['userName']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Contraseña: </label>
                    <input type="password" name="userPass1" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['userPass']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Nombre: </label>
                    <input type="text" name="nomPersona1" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['nomPersona']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Apellido: </label>
                    <input type="text" name="apelPersona1" class="form-control <?php //echo (isset($error['ApellidoP']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['apelPersona']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['ApellidoP']))?$error['ApellidoP']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Fecha nac: </label>
                    <input type="date" name="nac1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['nacPersona']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Teléfono: </label>
                    <input type="text" name="tel1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['telPersona']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div> 
                <div class="form-group col-md-4">
                    <label for="">DNI: </label>
                    <input type="text" class="form-control" name="dni1" value="<?php echo $filaUsuario['dniPersona']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['ApellidoM']))?$error['ApellidoM']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Dirección: </label>
                    <input type="text" name="dir1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['calleDom']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Nro: </label>
                    <input type="number" name="nro1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['numDom']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Piso: </label>
                    <select class="form-control" name="piso1"  >
                        <option value="<?php echo $filaUsuario['pisoDom'];?>" ><?php echo $filaUsuario['pisoDom'];?></option>
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
                    <input type="text" name="dpto1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaUsuario['dptoDom']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>               
                
                
                             
        </div>
        </div>
        <div class="modal-footer">      
                <button value="btnModificar" name="btnModificar" <?php //echo $accionModificar; ?>  class="btn btn-warning" type="submit" >Modificar</button>
                <button type="button" value="Cancelar" data-dismiss="modal" aria-label="Close" name="btnCancelar" class="btn btn-primary"><span aria-hidden="true">Cancelar</span></button>
        </div>
        </div>
        </div>
        </div>         
    </form>
        <div class="row" id="row" style="width: 1428px">
            <?php include_once('includes/sidebar.php');?>
            <div class="col-9"  style="background-color:#ddd ">
            <form action="" method="post">    
                <div class="row justify-content-start" id="buscador" style="background-color:#bad6ea">
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="text" name="buscarUsuario" class="form-control"  value="" placeholder="Buscar por usuario">
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" name="btnBuscar1" value="Buscar" class="btn btn-primary"  >
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="text" name="buscarApel" class="form-control"  value="" placeholder="Buscar por apellido"> 
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" name="btnBuscar2" value="Buscar" class="btn btn-primary"  >
                    </div>
                </div>
            </form>         
            <table class="table table-hover table-bordered" id="tabla">
                    
                    <thead id="thead1">
                        <tr>
                            <th>Usuario </th>
                            <th>Nombre </th>
                            <th>Apellido </th>
                            <th>Privilegios </th>
                            <th>Acciones </th>
                        </tr>
                    </thead>
                    <input type="hidden" name="txtID" value="form">
                    <?php foreach($matrizUsuario as $datos){ ?>
                    <tr class="table-info">
                        <td><?php echo $datos['userName']; ?></td>
                        <td><?php echo $datos['nomPersona']; ?> </td>
                        <td><?php echo $datos['apelPersona']; ?></td>
                        <td><?php echo $datos['userPriv']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="idUser" value="<?php echo $datos['idUsuario']; ?>">
                                <input type="hidden" name="idPers" value="<?php echo $datos['idPersona']; ?>">
                                <input type="hidden" name="idDom" value="<?php echo $datos['idDomicilio']; ?>">
                                <?php if((strcmp($_SESSION['userName'], $datos['userName']) === 0) || (strcmp($_SESSION['userName'], 'Admin') === 0)){ ?>
                                <input type="submit" value="Seleccionar" class="btn btn-info" name="accion" >
                                <button type="submit" value="btnEliminar" name="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');" class="btn btn-danger" >Eliminar</button>
                                <?php } ?> 
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                   <tr><td><?php
            //PAGINACIÓN
            //agrego el link a la pagina anterior 
            //si no tengo la variable q viaja por GET, debo mostrar el listado de la pagina 1, y el Anterior no debe ser link
            if (empty($_GET['pagina'])) {
                $PaginaAnterior = '';
                
            } else if ($_GET['pagina'] == 1) {
                //si tengo la variable q viaja por GET, y es la primer pagina, debo mostrar el listado de la pagina 1, y el Anterior tampoco debe ser link
                $PaginaAnterior = '';
                
            } else if ($_GET['pagina'] <= $total_paginas) {
                //si tengo la variable GET y es alguna pagina intermedia, agrego 1 para la proxima page
                $PaginaAnterior = '?pagina=' . ($_GET['pagina'] - 1);
            }
             echo '<ul class="pagination">';
            //se mostrara si estoy en la pagina 2 o superior.
            //No deberia ver una pagina anterior si estoy en la pagina 1 con los primeros registros
            if (!empty($PaginaAnterior)) {
                ?> 
                <li class="page-item">
                    <a class="page-link" href="menu_usuario.php<?php echo $PaginaAnterior; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                    </a>
                </li>
                
            <?php } 
//--------------------------Paginación-------------------------------------------------------
            for($i=1;$i<=$total_paginas;$i++){
                echo "<li class='page-item'><a class='page-link' href='?pagina=" . $i . "'>" . $i . "</a></li> ";
            }
            //agrego el link a la pagina siguiente 
            //si no tengo la variable q viaja por GET, debo mostrar el listado de la pagina 1, y el Siguiente apunta a la page 2
            if (empty($_GET['pagina'])) {
                $PaginaSiguiente = '?pagina=2';
            } else if ($_GET['pagina'] < $total_paginas) {
                //si tengo la variable GET y es alguna pagina intermedia, agrego 1 para la proxima page
                $PaginaSiguiente = '?pagina=' . ($_GET['pagina'] + 1);
            } else if ($_GET['pagina'] == $total_paginas) {
                //si la variable GET tiene el valor de la ultima pagina, no le doy valor al Siguiente
                $PaginaSiguiente = '';
            }
            if (!empty($PaginaSiguiente)) {
                ?> 
                <li class="page-item">
                  <a class="page-link" href="menu_usuario.php<?php echo $PaginaSiguiente; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Siguiente</span>
                  </a>
                </li>
                
            <?php } 
            echo '</ul>'; 
            ?>
            </td></tr>        
            </table>
        </div> 
         <?php if(isset($_POST['accion'])){ ?>
               <script>
                    $('#exampleModal').modal('show');
                </script>
                
            <?php } ?>
                <script>
                    function Confirmar(Mensaje){
                        
                        return(confirm(Mensaje))?true:false;          
                    }
                </script>
    </div>
    <?php include_once('includes/footer.php');?>
</body>
</html>
