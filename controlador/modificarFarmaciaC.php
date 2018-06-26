<?php

include_once '../modelo/farmaciasModelo.php';

  if(
        isset($_POST['idFarmacia']) && !empty($_POST['idFarmacia']) && is_numeric($_POST['idFarmacia']) &&
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['telefono']) && !empty($_POST['telefono']) && is_numeric($_POST['telefono']) &&
        isset($_POST['empresa']) && !empty($_POST['empresa']) &&
        isset($_POST['direccion']) && !empty($_POST['direccion']) &&
        isset($_POST['email']) && !empty($_POST['email'])
          
        
  ){
    $idFarmacia = $_POST['idFarmacia'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];
    
    $usuariosModelo = new farmaciasModelo();
    $datos = $usuariosModelo->modificarFarmacia($idFarmacia, $nombre, $direccion, $telefono, $email, $empresa);
    
    if($datos == 1){
        ?>
        <script>alert("Registro modificado");
        location = "listarFar.php";
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



