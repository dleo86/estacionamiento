<!doctype html>

<body>
   
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <!-- Navbar content 
    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>-->
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
                                <h5 class="modal-title" id="exampleModalLabel">Turnos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                             
        <div class="modal-body">
            <div class="form-row">
                <input type="hidden" name="idTurno1" value="<?php echo $filaTurno['idReserva']; ?>" placeholder="" required >              
                <input type="hidden" name="idLugar" value="<?php echo $filaTurno['Lugar_idLugar']; ?>" placeholder="" required >  
                <input type="hidden" name="idCaja" value="<?php echo $filaTurno['Caja_idCaja']; ?>" placeholder="" required >
                <input type="hidden" name="idUsu" value="<?php echo $filaTurno['Usuario_idUsuario']; ?>" placeholder="" required >
                <input type="hidden" name="idVeh1" value="<?php echo $filaTurno['Vehiculo_idVehiculo']; ?>" placeholder="" required >
               
                <div class="form-group col-md-4">
                    <label for="">Desde: </label>
                    <input type="text" name="desde1" class="form-control"  value="<?php echo $filaTurno['Desde']; ?>" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div> 
                <div class="form-group col-md-4">
                    <label for="">Hasta: </label>
                    <input type="text" name="hasta1" class="form-control"  value="<?php echo $filaTurno['Hasta']; ?>" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Costo: </label>
                    <input type="text" name="costo1" class="form-control"  value="<?php echo '$' . $filaTurno['Costo']; ?>" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Lugar: </label>
                    <input type="text" name="lugar1" class="form-control"  value="<?php echo $filaTurno['Lugar']; ?>" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Patente: </label>
                    <input type="text" name="patente1" class="form-control"  value="<?php echo $filaTurno['patente']; ?>" >
                    <div class="invalid-feedback">
                        <?php// echo (isset($error['Correo']))?$error['Correo']:""; ?>
                    </div>
                    <br>
                </div>
                                   
            </div>
        </div>
        <div class="modal-footer">      
                <button value="btnModificar" name="btnModificar" class="btn btn-warning" type="submit" >Modificar</button>
                <button type="button" value="Cancelar" data-dismiss="modal" aria-label="Close" name="btnCancelar" class="btn btn-primary"><span aria-hidden="true">Cancelar</span></button>
                    </form>
                <form action="mostrarPDF.php" target="_black" method="post" enctype="multipart/form-data">  
                    <input type="hidden" name="idTurno1" value="<?php echo $filaTurno['idReserva']; ?>" placeholder="" required >
                    <button value="Mostrar PDF" name="btnPdf" class="btn btn-danger" type="submit" >Mostrar PDF</button>                    
                  </form>      
        </div>
        </div>
        </div>
        </div>         
        <div class="row" id="row" style="width: 1428px">
            <?php include_once('includes/sidebar.php');?>
            <div class="col-9"  style="background-color:#ddd ">
                <form action="" method="post"> 
                <div class="row justify-content-start" id="buscador" style="background-color:#bad6ea">
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="number" name="buscarCaja" class="form-control"  value="" placeholder="Buscar por caja">
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" name="btnBuscar1" value="Buscar" class="btn btn-primary"  >
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="text" name="buscarPatente" class="form-control"  value="" placeholder="Buscar por patente"> 
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" value="Buscar" class="btn btn-primary" name="btnBuscar2" >
                    </div>
                </div>  
                </form>
                <table class="table table-hover table-bordered" id="tabla">
                    
                    <thead id="thead1">
                        <tr>   
                            <th>Desde </th>
                            <th>Hasta </th>
                            <th>Costo</th>
                            <th>Lugar</th>
                            <th>Estado</th>
                            <th>Caja</th>
                            <th>Usuario</th>
                            <th>Patente</th>
                            <th>Acciones </th>
                        </tr>
                    </thead>
                    <input type="hidden" name="txtID" value="form">
                    <tr class="table-info">   
                        <form action="" method="post"> 
                        <td ><input type="datetime" name="desde" class="form-control"  value="" placeholder="" readonly></td>
                        <td ><input type="datetime" name="hasta" class="form-control"  value="" placeholder="" readonly></td>
                        <td><input type="number" name="costo" class="form-control"  value="50" placeholder="" readonly ></td>
                        <td><select class="form-control" name="lugar" >                       
                         <?php foreach($filaLugar as $datos1){ ?>
			<?php echo "<option value='". $datos1['idLugar']. "'>". $datos1['Lugar'] . "</option>"; ?>
			<?php } ?>
                        </select></td>
                        <td><input type="text" name="estado" class="form-control"  value="" placeholder="" readonly></td>
                        <td><input type="number" name="caja" class="form-control"  value="" placeholder="" readonly></td>
                        <td><input type="text" name="usuario" class="form-control"  value="<?php echo $_SESSION['userName']; ?>" placeholder="" readonly></td>
                        <td><input type="text" name="patente" class="form-control"  value=""></td>
                        <td>
                            <input type="submit" value="Agregar" class="btn btn-primary" name="btnAgregar" >
                        </form>
                        </td>
                    </tr>
                    <?php $color = "success"?>
                    <?php foreach($matrizTurno as $datos){ ?>
                   
                        <?php if($datos['Est'] != "Ocupado"){
                            $color = "danger";
                        } else{
                            $color = "success";
                        }
                        ?> 
                      <tr class="<?php echo 'table-'.$color?>">
                        <td><?php echo utf8_encode( date('d-m-Y H:i:00', strtotime($datos['Desde']))); ?></td>
                        <td><?php echo utf8_encode( date('d-m-Y H:i:00', strtotime($datos['Hasta']))); ?> </td>
                        <td><?php echo '$' . $datos['Costo']; ?></td>
                        <td><?php echo $datos['Lugar']; ?></td>
                        <td><?php echo $datos['Est']; ?></td>
                        <td><?php echo $datos['Caja_idCaja']; ?></td>
                        <td><?php echo $datos['userName']; ?></td>
                        <td><?php echo $datos['patente']; ?></td>
                                          
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="idTurno" value="<?php echo $datos['idReserva']; ?>">
                                <input type="hidden" name="idLugar" value="<?php echo $datos['Lugar_idLugar']; ?>">
                                <input type="hidden" name="idCaja" value="<?php echo $datos['Caja_idCaja']; ?>">
                                <input type="hidden" name="idUsu" value="<?php echo $datos['Usuario_idUsuario']; ?>">
                                <input type="hidden" name="idVeh" value="<?php echo $datos['Vehiculo_idVehiculo']; ?>">
                                <input type="submit" value="Seleccionar" class="btn btn-info" name="accion" >
                                <button type="submit" value="btnDesocupar" name="btnDesocupar"  class="btn btn-warning" >Desocupar</button>
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
                    <a class="page-link" href="menu_reserva.php<?php echo $PaginaAnterior; ?>" aria-label="Previous">
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
                  <a class="page-link" href="menu_reserva.php<?php echo $PaginaSiguiente; ?>" aria-label="Next">
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
    </div>
    <script>
        function Confirmar(Mensaje){
                        
            return(confirm(Mensaje))?true:false;          
        }
    </script>
    <?php include_once('includes/footer.php');?>
</body>
</html>
