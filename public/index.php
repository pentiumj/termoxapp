<?php session_start(); ?>
<?php if(isset($_SESSION['cedula'])){ header('Location: '.'inicio.php'); } ?>

<?php include_once 'validarUsuario.php'; ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no, minimal-ui"/>

    <title>TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
   
    <link rel="stylesheet" href="css/reset.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/login.css">
  </head>

  <body onload="document.forminiciar.cedula.focus()">
    <div class="pen-title">
      <center><a href="index.php" id="imgCabecera" title="Sistema de control termohigrométrico para farmacias"></a></center>
      
    </div>
  
    <div class="module form-module">
      <div class="toggle">
        
      </div>
      <div class="form">
        <h2>Ingrese a su cuenta</h2>
        <form method="POST" id="form-iniciar" name="forminiciar">
            <input type="text" name="cedula" placeholder="Usuario" required/>
            <input type="password" name="pass" placeholder="Contraseña" required/>
          <button>Ingresar</button>
        </form>
      </div>
      
      <!-- <div class="cta"><a href="http://andytran.me">Forgot your password?</a></div> -->
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/jquery.validate.js"></script>
    <script>
        $(document).ready(function(){           
           $("#form-iniciar").validate();
        });
    </script>
    <script src="js/login.js"></script>
  </body>
</html>
