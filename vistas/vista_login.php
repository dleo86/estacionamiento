
<div class="login">
  
  <h2 class="login-header">Login - IREL</h2>

  <form class="login-container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">  
      <?php
         if(!empty($_SESSION['Mensaje'])){
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <p class="m-none text-semibold h6">
              Los datos son incorrectos
          </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <?php
         }
      ?>
      <p><input type="text" name="Usuario" placeholder="Usuario" value="" ></p>
      <p><input type="password" name="Password" id="pass" placeholder="Password" value=""><i onclick="Mostrar()" class="fas fa-eye-slash" id="display"></i></p>
     
      <p><input type="submit" name="btnIngresar" value="Ingresar"></p>
      <a href="menu_registro.php" id="reg">Registrarse</a>
  </form>
</div>
