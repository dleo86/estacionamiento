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
                                <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                             
        <div class="modal-body">
            <div class="form-row">
                <input type="hidden" name="idCliente1" value="<?php echo $filaCliente['idCliente']; ?>" placeholder="" required >              
                <input type="hidden" name="IDpers1" value="<?php echo $filaCliente['idPersona']; ?>" placeholder="" required >  
                <input type="hidden" name="IDdom1" value="<?php echo $filaCliente['idDomicilio']; ?>" placeholder="" required >
                <input type="hidden" name="IDdom1" value="<?php echo $filaCliente['idVehiculo']; ?>" placeholder="" required >
                <div class="form-group col-md-4">
                    <label for="">Nombre: </label>
                    <input type="text" name="nomPersona1" class="form-control <?php //echo (isset($error['Nombre']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['nomPersona']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['Nombre']))?$error['Nombre']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Apellido: </label>
                    <input type="text" name="apelPersona1" class="form-control <?php //echo (isset($error['ApellidoP']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['apelPersona']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['ApellidoP']))?$error['ApellidoP']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Fecha nac: </label>
                    <input type="date" name="nac1" class="form-control "  value="<?php echo $filaCliente['nacPersona']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Teléfono: </label>
                    <input type="text" name="tel1" class="form-control "  value="<?php echo $filaCliente['telPersona']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div> 
                <div class="form-group col-md-4">
                    <label for="">DNI: </label>
                    <input type="text" class="form-control" name="dni1" value="<?php echo $filaCliente['dniPersona']; ?>" placeholder="" required >
                    <div class="invalid-feedback">
                        <?php //echo (isset($error['ApellidoM']))?$error['ApellidoM']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Dirección: </label>
                    <input type="text" name="dir1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['calleDom']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Nro: </label>
                    <input type="number" name="nro1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['numDom']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Piso: </label>
                    <select class="form-control" name="piso1"  >
                        <option value="<?php echo $filaCliente['pisoDom'];?>" ><?php echo $filaCliente['pisoDom'];?></option>
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
                    <input type="text" name="dpto1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['dptoDom']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>               
                <div class="form-group col-md-2">
                    <label for="">Patente: </label>
                    <input type="text" name="patente1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['patente']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Marca: </label>
                    <input type="text" name="marca1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['marca']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Modelo: </label>
                    <input type="number" name="modelo1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['modelo']; ?>" placeholder=""   >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-2">
                    <label for="">Año: </label>
                    <input type="number" name="anio1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCliente['anio']; ?>" placeholder=""   >
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
                    <input type="text" name="buscarApel" class="form-control"  value="" placeholder="Buscar por apellido">
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" name="btnBuscar1" value="Buscar" class="btn btn-primary"  >
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="text" name="buscarPat" class="form-control"  value="" placeholder="Buscar por patente"> 
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" name="btnBuscar2" value="Buscar" class="btn btn-primary"  >
                    </div>
                </div>
            </form>        
            <table class="table table-hover table-bordered" id="tabla">
                    
                    <thead id="thead1">
                        <tr>
                            <th>Nombre </th>
                            <th>Apellido </th>
                            <th>DNI </th>
                            <th>Teléfono</th>
                            <th>Patente Vehículo</th>
                            <th>Acciones </th>
                        </tr>
                    </thead>
                    <input type="hidden" name="txtID" value="form">
                    <?php foreach($matrizCliente as $datos){ ?>
                    <tr class="table-info">
                        <td><?php echo $datos['nomPersona']; ?></td>
                        <td><?php echo $datos['apelPersona']; ?> </td>
                        <td><?php echo $datos['dniPersona']; ?></td>
                        <td><?php echo $datos['telPersona']; ?></td>
                         <td><?php echo $datos['patente']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="idCli" value="<?php echo $datos['idCliente']; ?>">
                                <input type="hidden" name="idPers" value="<?php echo $datos['idPersona']; ?>">
                                <input type="hidden" name="idDom" value="<?php echo $datos['idDomicilio']; ?>">                         
                                <input type="submit" value="Seleccionar" class="btn btn-info" name="accion" >
                                <button type="submit" value="btnEliminar" name="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?');" class="btn btn-danger" >Eliminar</button>
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
                    <a class="page-link" href="menu_clientes.php<?php echo $PaginaAnterior; ?>" aria-label="Previous">
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
                  <a class="page-link" href="menu_clientes.php<?php echo $PaginaSiguiente; ?>" aria-label="Next">
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
