<?php

include_once '../modelo/usuariosModelo.php';

  if(
        isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) &&
        isset($_POST['cedula']) && !empty($_POST['cedula']) && is_numeric($_POST['cedula']) &&
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['contrasena']) && !empty($_POST['contrasena']) &&
        isset($_POST['email']) && !empty($_POST['email'])
        
          
        
  ){
    $idUsuario = $_POST['idUsuario'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contrasena = $_POST['contrasena'];
    $email = $_POST['email'];
    
    
    $usuariosModelo = new usuariosModelo();
    $datos = $usuariosModelo->modificarUsuarioAdmin($idUsuario, $cedula, $nombre, $apellido, $contrasena, $email);
    
    if($datos == 1){
        ?>
        <script>alert("Registro modificado");
        location = "listarAdm.php";
        </script>
<?php
    }
    else{ 
       ?>
        <script>alert("Error al modificar");</script>
<?php
    }
    
  }else{
      ?>
        <script>alert("Verifique los datos");</script>
<?php
  }



