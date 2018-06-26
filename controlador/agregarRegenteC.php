<?php

include_once '../modelo/usuariosModelo.php';
if($_POST){
  if(
        isset($_POST['cedula']) && !empty($_POST['cedula']) && is_numeric($_POST['cedula']) &&
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['contrasena']) && !empty($_POST['contrasena'])
        
  ){
    
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];
    $tipoUsuario = 3;
    $idFarmacia = $_SESSION['idFarmacia'];
    
    $usuariosModelo = new usuariosModelo();
    $datos = $usuariosModelo ->agregarUsuarios($cedula, $nombre, $apellido, $contrasena, $email, $tipoUsuario, $idFarmacia);
    
    if($datos == 1){
        ?>
        <script>alert("Regente agregado");location = "regentes.php";</script> 
<?php
    }else{
        ?>
        <script>alert("Error al agregar. Verique sus datos");location = "regentes.php"</script> 
<?php
        
    }
  }else{
        ?>
        <script>alert("Verifique los datos ingresados");location = "regentes.php"</script> 
<?php
        
    }
}

