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
                                <h5 class="modal-title" id="exampleModalLabel">Caja</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                             
        <div class="modal-body">
            <div class="form-row">
                <input type="hidden" name="idCaja1" value="<?php echo $filaCaja['idCaja']; ?>" placeholder="" required >                           
               
                <div class="form-group col-md-4">
                    <label for="">Total: </label>
                    <input type="text" name="total1" class="form-control <?php //echo (isset($error['Correo']))?"is-invalid":""; ?>"  value="<?php echo $filaCaja['totalCaja']; ?>" placeholder=""   >
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
                        <input type="date" name="BuscarFecha" class="form-control"  value="" placeholder="Buscar por caja">
                    </div>
                    <div class="col-3"  style="background-color:#bad6ea">
                    <input type="submit" value="Buscar" class="btn btn-primary" name="btnBuscar1" >
                    </div>        
                </div>  
            </form>
            <table class="table table-hover table-bordered" id="tabla">
                    
                    <thead id="thead1">
                        <tr>
                            <th># </th>
                            <th>Fecha </th>
                            <th>Total </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tr class="table-info">
                        <form action="" method="post" >
                            <td><input type="number" value=""  readonly></td>
                            <td><input type="date" value=""  readonly></td>
                            <td><input type="number" value="0"  readonly></td>
                            <td><input type="submit" value="Agregar" class="btn btn-primary" name="btnAgregar"></td>                                       
                        </form> 
                    </tr>
                    <input type="hidden" name="txtID" value="form">
                    <?php foreach($matrizCaja as $datos){ ?>
                    <tr class="table-info">
                        
                        <td><?php echo $datos['idCaja']; ?></td>
                        <td><?php echo utf8_encode( date('d-m-Y H:i:00', strtotime($datos['fechaCaja']))); ?> </td>
                        <td><?php echo '$' . $datos['totalCaja']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="idCaja" value="<?php echo $datos['idCaja']; ?>">
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
                    <a class="page-link" href="menu_caja.php<?php echo $PaginaAnterior; ?>" aria-label="Previous">
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
                  <a class="page-link" href="menu_caja.php<?php echo $PaginaSiguiente; ?>" aria-label="Next">
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
