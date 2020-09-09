<!DOCTYPE html>

<?php require_once 'includes/header.php'; ?>
    <body>
        <?php
          session_start();
          if(!isset($_SESSION['userName'])){
            header('Location: login.php');
          }
          require_once ('controladores/controlador_reserva.php');
          
        ?>
    </body>
    <?php require_once 'includes/footer.php'; ?>
</html>
