 <aside id="left-panel" class="left-panel">
        <nav class=" navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                
                <ul class="navbar-btn">
                    <nav class="navbar navbar-expand-lg"><h4><?php echo 'Usuario: ' . $_SESSION['userName']; ?></h4></nav>
                    <li class="active">
                        <a href="index.php" style="color: #2d690e;"><i class="menu-icon fa fa-laptop mr-3"></i>Inicio </a>
                    </li>
                   
                    <li>
                        <a href="menu_reserva.php" style="color: #2d690e;"> <i class="menu-icon fa fa-table mr-3"></i>Reserva </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" style="color: #2d690e;" aria-expanded="false"> <i class="fas fa-code mr-3" style="color: #2d690e;"></i>Usuarios</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th mr-3"></i><a href="menu_insUsuario.php" style="color: #2d690e;">Agregar usuario</a></li>
                            <li><i class="fa fa fa-table mr-3"></i><a href="menu_usuario.php" style="color: #2d690e;">Administrar usuarios</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="menu_lugar.php" style="color: #2d690e;"> <i class="menu-icon fa fa-table mr-3"></i>Lugar </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #2d690e;"> <i class="fas fa-code mr-3"></i>Clientes</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th mr-3"></i><a href="menu_insCliente.php" style="color: #2d690e;">Agregar cliente</a></li>
                            <li><i class="menu-icon fa fa-table mr-3"></i><a href="menu_clientes.php" style="color: #2d690e;">Administrar clientes</a>
                           
                        </li>

                        </ul>
                    </li>
                    <li>
                        <a href="menu_caja.php" style="color: #2d690e;"> <i class="menu-icon fa fa-table mr-3"></i>Caja </a>
                    </li>
                </ul>
            <!-- /.navbar-collapse -->
            </div>
        </nav>
    </aside>