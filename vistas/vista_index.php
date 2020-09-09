<!doctype html>


<body>
   
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <!-- Navbar content -->
  <span class="openbtn" >
      <button class="openbtn1" onclick="Nav()">&#9776;</button>
      <img src="img/logo.jpg"> 
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
    
        <div class="row">
            
            <?php include_once('includes/sidebar.php');?>
          
         <div class="col-3">        
          <div class="card h-100 bg-info text-black">
              <img class="card-img-top" height="250px" src="img/turno.jpg">            
            <div class="card-body">
              <h4 class="card-title">Reserva</h4>
              <p class="card-text">Gestione los turnos de los vehículos que ingresan y salen del estacionamiento.
                                   Puede ingresar, modificar o borrar los turnos asignados, también puede realizar descargas
                                   en pdf del importe.</p>
              <a href="menu_reserva.php" class="btn btn-success">Entrar</a>
            </div>
          </div>          
        </div>
       <div class="col-3">        
          <div class="card bg-info text-black">
            <img class="card-img-top" height="250px" src="img/caja.jpg">            
            <div class="card-body">
              <h4 class="card-title">Caja</h4>
              <p class="card-text">Administre las cajas ordenadas cada una por fecha. Puede ingresar una nueva caja o borrar 
                                   la misma. Los ingresos de las cajas se iran cargando automáticamente de acuedo a los turnos 
                                   asignados.</p>
              <a href="menu_caja.php" class="btn btn-success">Entrar</a>
            </div>
          </div>          
        </div>   
      <div class="col-3">        
          <div class="card h-100 bg-info text-black">
            <img class="card-img-top" height="250px" src="img/clientes.jpg">            
            <div class="card-body">
              <h4 class="card-title">Clientes</h4>
              <p class="card-text">Administre los datos de los clientes. Puede ingresar, modificar o borrar datos y llevar el control
                                   del ingreso o salida del vehículo de cada cliente.</p>
              <a href="menu_clientes.php" class="btn btn-success">Entrar</a>
            </div>
          </div>          
        </div>
               
      </div>      
    </div>
   